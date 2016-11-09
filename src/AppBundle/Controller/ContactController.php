<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;

/**
 * @Route()
 */
class ContactController extends Controller
{
    /**
     * @Route("/")
     * @Method("GET")
     */
    public function listAction()
    {
        $contacts = [];
        $entities = $this->get('contact_repository')->findAll();
        /** @var Contact $entity */
        foreach ($entities as &$entity) {
            $contacts[] = [
                'id' => $entity->getId(),
                'fist_name' => $entity->getFirstName(),
                'last_name' => $entity->getLastName(),
                'age' => $entity->getAge(),
            ];
        }

        return new JsonResponse([
            'data' => $contacts,
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/{id}")
     * @Method("GET")
     * @ParamConverter("contact", class="AppBundle\Entity\Contact")
     */
    public function viewAction(Contact $contact)
    {
        return new JsonResponse([
            'data' => [
                'id' => $contact->getId(),
                'fist_name' => $contact->getFirstName(),
                'last_name' => $contact->getLastName(),
                'age' => $contact->getAge(),
            ],
        ], Response::HTTP_OK);
    }

    /**
     * @Route("/")
     * @Method("POST")
     */
    public function addAction(Request $request)
    {
        $contact = (new Contact())
            ->setFirstName($request->request->get('first_name'))
            ->setLastName($request->request->get('last_name'))
            ->setAge($request->request->get('age'));
        $validator = $this->get('validator');
        $errors = $validator->validate($contact);
        if (count($errors) > 0) {
            $errorsMessages = [];
            /** @var ConstraintViolation $error */
            foreach ($errors as &$error) {
                $errorsMessages[] = $error->getMessage();
            }

            return new JsonResponse([
                'error' => $errorsMessages,
            ], Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}")
     * @Method("PUT")
     * @ParamConverter("contact", class="AppBundle\Entity\Contact")
     */
    public function editAction(Request $request, Contact $contact)
    {
        if ($request->request->has('first_name')) {
            $contact->setFirstName($request->request->get('first_name'));
        }
        if ($request->request->has('last_name')) {
            $contact->setLastName($request->request->get('last_name'));
        }
        if ($request->request->has('age')) {
            $contact->setAge($request->request->get('age'));
        }
        $validator = $this->get('validator');
        $errors = $validator->validate($contact);
        if (count($errors) > 0) {
            return new JsonResponse([
                'error' => $errors,
            ], Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($contact);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/{id}")
     * @Method("DELETE")
     * @ParamConverter("contact", class="AppBundle\Entity\Contact")
     */
    public function removeAction(Contact $contact)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($contact);
        $em->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
