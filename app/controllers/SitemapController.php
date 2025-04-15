<?php

namespace app\controllers;

use core\Controller;
use app\models\User;  // Adjusted import statement
use app\helpers\Blogs;  // Adjusted import statement
class SitemapController extends Controller
{


    public function sitemap()
    {
        // Example usage
        // Load and decode the JSON file
        $jsonFile = 'app/helpers/blogs.json';
        $categories = json_decode(file_get_contents($jsonFile), true);

        if ($categories === null) {
            die("Error: Could not read or parse the JSON file.");
        }

        // Create a new XML document
        $xml = new \DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput = true;

        // Add the <urlset> root element
        $urlset = $xml->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $urlset->setAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1'); // Add 
        $xml->appendChild($urlset);
        $date = date('Y-m-d');

        // Add static pages (Home and Contact Us) to the sitemap 
        $manualImages = [
            [
                'page' => $this->getMainUrl() . '/',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],
            [
                'page' => $this->getMainUrl() . '/projects',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],
            [
                'page' => $this->getMainUrl() . '/blogs',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],

            // landing page
            [
                'page' => $this->getMainUrl() . '/creation-site-web',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/villes/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],
            [
                'page' => $this->getMainUrl() . '/strategie-communication',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/villes/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],
            [
                'page' => $this->getMainUrl() . '/marketing-digital',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/villes/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],

            // policies
            [
                'page' => $this->getMainUrl() . '/conditions-utilisation',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ],
            [
                'page' => $this->getMainUrl() . '/politique-de-confidentialite',
                'image' => 'https://www.lacasadecom.ma/public/assets/images/lacasadecom-creation-site-web.webp',
                'caption' => 'Création des sites web - la casa de com '
            ]
        ];

        foreach ($manualImages as $manualImage) {
            $url = $xml->createElement( 'url');
            $loc = $xml->createElement('loc', htmlspecialchars($manualImage['page']));
            $url->appendChild($loc);

            // Add the image tag
            $imageTag = $xml->createElement('image:image');
            $imageLoc = $xml->createElement('image:loc', htmlspecialchars($manualImage['image']));
            $imageTag->appendChild($imageLoc);
            $imageCaption = $xml->createElement('image:caption', htmlspecialchars($manualImage['caption']));
            $imageTag->appendChild($imageCaption);
            $url->appendChild($imageTag);

            // Optionally, you can add <lastmod>, <changefreq>, <priority> etc.
            $lastmod = $xml->createElement('lastmod', $date);
            $url->appendChild($lastmod);

            // Add changefreq and priority
            $changefreq = $xml->createElement('changefreq', 'monthly');
            $url->appendChild($changefreq);
            $priority = $xml->createElement('priority', '0.7');
            $url->appendChild($priority);

            // Append to the <urlset>
            $urlset->appendChild($url);
        }






        // Loop through categories and add each blog as <url> entry in XML
        foreach ($categories  as $category => $projects) {

            foreach ($projects as $project) {

                $url = $xml->createElement('url');
                $title = str_replace(" ", "-", $project['title']);
                $blogURL = $this->getMainUrl()  . '/'   . $category      . '/' . $title;
                $loc = $xml->createElement('loc', htmlspecialchars($blogURL));
                $url->appendChild($loc);
                $lastmod = $xml->createElement('lastmod', $date);
                $url->appendChild($lastmod);

                // Add image (if exists)
                if (!empty($project['path_image'])) {
                    $imageUrl = 'https://www.lacasadecom.ma/public/' . $project['path_image'];
                    $imageTag = $xml->createElement('image:image');
                    $imageLoc = $xml->createElement('image:loc', htmlspecialchars($imageUrl));
                    $imageTag->appendChild($imageLoc);
                    $imageCaption = $xml->createElement('image:caption', htmlspecialchars($project['title']));
                    $imageTag->appendChild($imageCaption);
                    $url->appendChild($imageTag);
                }

                // Add changefreq and priority (optional)
                $changefreq = $xml->createElement('changefreq', 'monthly');
                $url->appendChild($changefreq);
                $priority = $xml->createElement('priority', '0.7');
                $url->appendChild($priority);

                // Append to the <urlset>
                $urlset->appendChild($url);
            }
        }



        // Save the XML to a file
        $sitemapFile = 'sitemap.xml';
        $xml->save($sitemapFile);
        $this->render('notfound', []);
    }

    public function getMainUrl()
    {
        // Get the protocol (HTTP or HTTPS)
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        // Get the server name (domain name)
        $host = $_SERVER['HTTP_HOST'];
        // Get the base URL (without request URI)
        return $protocol . $host;
    }
}
