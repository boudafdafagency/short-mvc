<?php

namespace app\helpers;  // Adjusted namespace
class Blogs
{
    private $posts = [];

    public function __construct($jsonFilePath)
    {
        $this->loadPosts($jsonFilePath);
    }

    // Load blog posts from the JSON file
    private function loadPosts($jsonFilePath)
    {
        if (!file_exists($jsonFilePath)) {
            throw new \Exception("File not found: $jsonFilePath");
        }

        $content = file_get_contents($jsonFilePath);
        $this->posts = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("Invalid JSON data.");
        }
    }

    // Get all posts
    public function getPosts()
    {
        return $this->posts;
    }

    // Get a specific post by ID
    public function getPostById($title, $category)
    {
        $categoryss = null;
        if (isset($this->posts[$category])) {
            $categoryss = $this->posts[$category];
        }
        if (isset($categoryss)) {
            foreach ($categoryss as $post) {
                $title = str_replace("-", " ", $title);
                $decodedtitle = urldecode($title);
                if ($post['title'] === $decodedtitle) {
                    return $post;
                }
            }
        }


        //  return null; // Return null if no post found
    }
}
