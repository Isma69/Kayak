<?php 

class TourOperator {
    protected int $id;
    protected string $name;
    protected string $link;

    public function __construct(int $id, string $name, string $link) {
        $this->id = $id;
        $this->name = $name;
        $this->link = $link;
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of link
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * Set the value of link
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}