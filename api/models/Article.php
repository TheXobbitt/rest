<?php
/**
 * Created by PhpStorm.
 * User: Oleksandr Blakov
 * Date: 12/27/17
 * Time: 13:00
 */

namespace rest\models;

use base\exceptions\ValidationException;
use base\models\Model;

/**
 * Class Article
 * @package rest\models
 */
class Article extends Model
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $title;
    /**
     * @var
     */
    protected $description;
    /**
     * @var
     */
    protected $body;

    /**
     * Article constructor.
     */
    private function __construct() {}

    /**
     * @param string $title
     * @param string $description
     * @param string $body
     * @return Article
     */
    public static function create(string $title, string $description, string $body): Article
    {
        $article = new self();
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
            throw new ValidationException('Title must be set');
        }
        $this->title = $title;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        if (empty($description)) {
            throw new ValidationException('Description must be set');
        }
        $this->description = $description;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        if (empty($body)) {
            throw new ValidationException('Body must be set');
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
}
