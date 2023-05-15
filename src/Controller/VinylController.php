<?php

namespace App\Controller; // App points to source directory (src in this case). \Controller points to the subdirectory.

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\String\u;

class VinylController
{
    #[Route('/')] // PHP 8 attribute syntax - adds configuration to code.
    public function homepage(): Response // Response here is the return type
    {
        return new Response('Title: PB and Jams'); // a Symfony controller MUST return a Symfony response object. We can place whatever we want to return to the user inside this Response (string, JSON, template, etc).
    }

    #[Route('/browse/{slug}')] // {} is a wildcard, allowing for flexible url extensions. 'slug' is the technical name for a URL-safe name - however any word can be used in this placeholder.
    public function browse(string $slug = null) : Response // Added string type to $slug argument. Null makes the $slug argument optional.
    {
        if ($slug) {
            $title = 'Genre: ' . u(str_replace('-', ' ', $slug))->title(true); // 'u' allows us to make string transformations, turning the string into an object that we can do string operations on (eg. ->title()).
        } else {
            $title = u('All genres')->title(true);
        }

        return new Response($title);
    }
}
