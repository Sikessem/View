<?php namespace Ends\Html;
/**
 * The page class
 *
 * @author SIGUI Kessé Emmanuel
 * @package sikessem/html
 * @license Apache-2.0
 */
class Document extends Tag {
  public function __construct(protected string $doctype, string $title, array $attributes = [], array $properties = []) {
    parent::__construct('html', $attributes, $properties);
    ($this->title = ($this->head = $this->addTag('head'))->addTag('title'))->addText($title);
    $this->body = $this->addTag('body');
  }

  /**
   * @var Tag The page head
   */
  protected Tag $head;

  /**
   * Get the page head
   *
   * @return Tag The page head
   */
  public function head(): Tag {
    return $this->head;
  }

  /**
   * @var Tag The page body
   */
  protected Tag $body;

  /**
   * Get the page body
   *
   * @return Tag The page body
   */
  public function body(): Tag {
    return $this->body;
  }

  /**
   * @var Tag The page title
   */
  protected Tag $title;

  /**
   * Get the page title
   *
   * @return Tag The page title
   */
  public function title(): Tag {
    return $this->title;
  }

  /**
   * Get the node render
   *
   * @return string The node render
   */
  public function render(): string {
    return "<!DOCTYPE {$this->doctype}>" . parent::render();
  }

  public function __toString(): string {
    return $this->render();
  }
}
