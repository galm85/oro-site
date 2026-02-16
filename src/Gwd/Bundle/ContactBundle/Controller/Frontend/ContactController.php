<?php

namespace Gwd\Bundle\ContactBundle\Controller\Frontend;

use Oro\Bundle\LayoutBundle\Attribute\Layout;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{


    #[Route('/contact',name:'contact_us')]
    #[Layout]
    public function indexAction(Request $request):array
    {
        return [];
    }

    #[Route('/contact/submit',name:'contact_us_submit')]
    public function submitAction(Request $request,MailerInterface $mailer):Response
    {
        $firstName = $request->request->get('firstName');
        $lastName = $request->request->get('lastName');
        $phone = $request->request->get('phone');
        $email = $request->request->get('email');
        $subject = $request->request->get('subject');
        $message = $request->request->get('message');

        $emailMessage = (new Email())
            ->from($email)
            ->to('galm85@gmail.com')
            ->subject('Contact Form' . $subject)
            ->html("
                            <h3>New Contact Form Submission</h3>
                <p><strong>Name:</strong> {$firstName} - {$lastName}</p>
                <p><strong>Phone:</strong> {$phone}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong></p>
                <p>{$message}</p>
            ");

        $mailer->send(($emailMessage));
        $this->addFlash('success','Thank you');

        return $this->redirectToRoute('contact_us');


    }

}