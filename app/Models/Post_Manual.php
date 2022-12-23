<?php

namespace App\Models;

class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Pertama",
            "slug" => "judul-pertama",
            "author" => "Sano Manjiro",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur illo inventore repellat eveniet delectus quos totam vitae, aliquam enim quo repellendus quae id nulla nesciunt aperiam voluptatem deleniti eaque, officia dolore iusto! Ea sit expedita eligendi, fugiat veritatis consectetur possimus sequi assumenda mollitia dolorum enim deleniti architecto sint laboriosam. Dolores rem molestiae ab numquam necessitatibus totam tenetur maiores ullam maxime iusto, ducimus enim iste libero velit cum culpa accusantium asperiores? Mollitia recusandae aspernatur esse repudiandae porro aperiam possimus provident pariatur quos hic, debitis suscipit repellat voluptates ex consectetur, assumenda magni corrupti placeat delectus eius eligendi nemo? Corporis debitis harum dicta!"
        ],
        [
            "title" => "Judul Kedua",
            "slug" => "judul-ke-dua",
            "author" => "Takemichi",
            "body" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur illo inventore repellat eveniet delectus quos totam vitae, aliquam enim quo repellendus quae id nulla nesciunt aperiam voluptatem deleniti eaque, officia dolore iusto! Ea sit expedita eligendi, fugiat veritatis consectetur possimus sequi assumenda mollitia dolorum enim deleniti architecto sint laboriosam. Dolores rem molestiae ab numquam necessitatibus totam tenetur maiores ullam maxime iusto, ducimus enim iste libero velit cum culpa accusantium asperiores? Mollitia recusandae aspernatur esse repudiandae porro aperiam possimus provident pariatur quos hic, debitis suscipit repellat voluptates ex consectetur, assumenda magni corrupti placeat delectus eius eligendi nemo? Corporis debitis harum dicta!"
        ]
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug);
    }
}
