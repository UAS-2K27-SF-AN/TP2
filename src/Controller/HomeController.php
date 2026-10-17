<?php
namespace App\Controller;
use App\Service\MessageService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', ['message' => 'Bienvenue sur Symfony 7']);
    }
    #[Route('/hello/{name}', name: 'app_hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', ['name' => ucfirst($name)]);
    }
    #[Route('/addition/{a}/{b}', name: 'app_addition')]
    public function addition(int $a, int $b): Response
    {
        return $this->render('home/addition.html.twig', [
            'a' => $a,
            'b' => $b,
            'result' => $a + $b,
        ]);
    }
    #[Route('/motivation', name: 'app_motivation')]
    public function motivation(MessageService $messageService): Response
    {
        return $this->render('home/motivation.html.twig', ['message' => $messageService->getDailyMessage()]);
    }
    #[Route('/redirect', name: 'app_redirect')]
    public function redirectToHome(): Response
    {
        return $this->redirectToRoute('app_index');
    }

    #[Route('/boom', name: 'app_boom')]
    public function boom(): Response
    {
        throw new \Exception('Erreur volontaire !');
    }

    #[Route('/author', name: 'app_author')]
    public function author(ParameterBagInterface $params): Response
    {
        return new Response('Auteur du projet : ' . $params->get('app.author'));
    }

    #[Route('/log', name: 'app_log')]
    public function log(LoggerInterface $logger): Response
    {
        $logger->info('Un utilisateur a visité la page log.');

        return new Response('Message enregistré dans les logs !');
    }
}
