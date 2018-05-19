<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Person;
use AppBundle\Entity\EntityMerger;
use AppBundle\Exception\ValidationException;
use FOS\RestBundle\Controller\ControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HumansController extends  AbstractController
{
    use ControllerTrait;

    /**
     * @var EntityMerger
     */

    private $entityMerger;

    /**
     * @Rest\View()
     */
    public function __construct(EntityMerger $entityMerger) {
        $this->entityMerger = $entityMerger;
    }

    /**
     * @Rest\View()
     */
    public  function getHumansAction(){

        $people = $this->getDoctrine()->getRepository('AppBundle:Person')->findAll();

        return $people;
    }

    /**
     * @Rest\View()
     * @ParamConverter("person", converter="fos_rest.request_body")
     * @Rest\NoRoute()
     */
    public function postHumansAction(Person $person, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($person);
        $em->flush();

        return $person;
    }

    /**
     * @Rest\NoRoute()
     * @ParamConverter("modifiedPerson", converter="fos_rest.request_body",
     *     options={
     *         "validator"={"groups"={"Patch"}},
     *         "deserializationContext"={"groups"={"Deserialize"}}
     *     }
     * )
     */
    public function patchHumansAction(
        ?Person $thePerson, Person $modifiedPerson,
        ConstraintViolationListInterface $validationErrors)
    {
        if (null === $thePerson) {
            throw new NotFoundHttpException();
        }

        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }

        $this->entityMerger->merge(
            $thePerson,
            $modifiedPerson
        );
        $this->persistPerson($thePerson);

        return $thePerson;
    }

    /**
     * @Rest\View()
     */
    public function deleteHumanAction(Person $person){

        if (null==$person){
            return $this->view(null, 404);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();
    }

    /**
     * @Rest\View()
     */
    public function getHumanAction(Person $thePerson){

        if(null == $thePerson){
            return $this->view(null,404);
        }

        return $thePerson;
    }

    /**
     * @Rest\View()
     */
    public function getUserIdAction($mail){

        $em = $this->getDoctrine()->getRepository('AppBundle:Person')->findBy(array('mail' => $mail));
        return $em;
    }

    /**
     * @param Person $person
     */
    protected function persistPerson(Person $person): void
    {
        $em = $this->getDoctrine()
            ->getManager();
        $em->persist($person);
        $em->flush();
    }
}