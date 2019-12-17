<?php

namespace App\Controller;

use App\Entity\Ads;
use App\Form\AdType;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Route("/ad", name="ads")
     */
class AdController extends AbstractController
{

    /**
     * Display all ads
     * 
     * @Route("s", name="ads")
     */
    public function index()
    {
        return $this->render('ad/index.html.twig', []);
    }

    /**
     * Create a ad
     * 
     * @Route("/create", name="create_ad")
     */
    public function create(Request $request)
    {
        //Create a new ad
        $ad = new Ads();
        // create form
        $form = $this->createForm(AdType::class, $ad);
        //retrieve handle request
        $form->handleRequest($request);

        // When the form is submited and valid
        if ($form->isSubmitted() && $form->isValid()) {

            // set langage of user
            $ad->setLangage(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
            // slug
            $slugify = new Slugify();
            $ad->setSlug($slugify->slugify($ad->getTitle()));
            // add createdBy
            $ad->setCreatedBy($this->getUser());
            // add Category

            // add location
            //..
            // persist and flush ad
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ad);
            $manager->flush();
            
            $this->addFlash(
                'success',
                "Ad has been created"
            );

            return $this->redirectToRoute('read_ad', ['id' => $this->ad->getId()]);
        }
        

        return $this->render('ad/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * 
     * 
    * @Route("read/{id}", name="read_ad")
    */
    public function read( Ads $ad)
    {
        return $this->render('ad/read.html.twig', [
            'ad' => $ad
        ]);
    }

    /**
    * @Route("{id}/edit", name="edit_ad")
    */
    public function edit(Ads $ad)
    {

        return $this->render('ad/edit.html.twig', []);
    }

    /**
    * Remove manager. 
    *
    * @Route("{id}/delete", name="delete_ad")
    */
    public function delete( Ads $ad)
    {

        $manager = $entityManager = $this->getDoctrine()->getManager();
        //remove manager
        $manager->remove($ad);
        $manager->flush();
        
        $this->addFlash(
            'success',
            "Article has been deleted"
        );



        return $this->render('ad/delete.html.twig', []);
    }
}
