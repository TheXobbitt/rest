<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:00
 */

namespace rest\models;

use rest\components\Arrayable;
use UnexpectedValueException;

/**
 * Class Article
 * @package rest\models
 */
class Article implements Arrayable
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $description;
    /**
     * @var
     */
    private $body;

    /**
     * Article constructor.
     */
    private function __construct() {}

    /**
     * @param int $id
     * @param string $title
     * @param string $description
     * @param string $body
     * @return Article
     */
    public static function create(int $id, string $title, string $description, string $body): Article
    {
        $article = new self();
        $article->setId($id);
        $article->setTitle($title);
        $article->setDescription($description);
        $article->setBody($body);

        return $article;
    }

    /**
     * @param array $attributes
     * @return Article
     */
    public static function populate(array $attributes): Article
    {
        $article = new self();
        foreach ($attributes as $attribute => $value) {
            if (property_exists($article, $attribute)) {
                $article->$attribute = $value;
            }
        }

        return $article;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        if (empty($title)) {
            throw new UnexpectedValueException('Title must be set');
        }
        $this->title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        if (empty($description)) {
            throw new UnexpectedValueException('Description must be set');
        }
        $this->description = $description;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        if (empty($body)) {
            throw new UnexpectedValueException('Body must be set');
        }
        $this->body = $body;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param array $data
     * @return Article
     */
    public function updateFields(array $data): Article
    {
        foreach ($data as $attribute => $value) {
            $methodName = 'set' . ucfirst($attribute);
            if (method_exists($this, $methodName)) {
                call_user_func([$this, $methodName], $value);
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'body' => $this->body,
        ];
    }
}
