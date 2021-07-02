<?php namespace Ends\Html;
/**
 * The tag class
 *
 * @author SIGUI Kessé Emmanuel
 * @package sikessem/html
 * @license Apache-2.0
 */
class Tag extends Node {
  /**
   * Create a new tag
   *
   * @param array $attributes The tag attributes
   */
  public function __construct(protected string $name, array $attributes = []) {
    $this->setAttributes($attributes);
  }

  /**
   * Get the tag name
   *
   * @return string The tag name
   */
  public function name(): string {
    return $this->name;
  }

  /**
   * @var array The tag attributes
   */
  protected array $attributes = [];

  /**
   * Set the tag attributes
   *
   * @param array $attributes The attributes list
   * @return self
   */
  public function setAttributes(array $attributes): self {
    foreach($attributes as $name => $value)
      $this->setAttribute($name, $value);
    return $this;
  }

  /**
   * Set a attribute of the tag
   *
   * @param string $name The attribute name
   * @param string $value The attribute value
   * @return self
   */
  public function setAttribute(string $name, string $value): self {
    $this->attributes[$name] = $value;
    return $this;
  }

  /**
   * Get the tag attributes
   *nm
   * @return array The attributes list
   */
  public function getAttributes(): array {
    return $this->attributes;
  }

  /**
   * Get a attribute of the tag
   *
   * @param string $name The attribute name
   * @return string|null The attribute value
   */
  public function getAttribute(string $name): ?string {
    return $this->attributes[$name] ?? null;
  }

  /**
   * Check if the tag has attributes
   *
   * @return bool The tag has attributes
   */
  public function hasAttributes(): bool {
    return !empty($this->attributes);
  }

  /**
   * Check if the tag has a attribute
   *
   * @param string $name The attribute name
   * @return bool The tag has the attribute
   */
  public function hasAttribute(string $name): bool {
    return isset($this->attributes[$name]);
  }

  /**
   * @var array The tag content
   */
  protected array $nodes = [];

  /**
   * Add a text node
   *
   * @param string $text The text value
   * @return Text The text node
   */
  public function addText(string $text): Text {
    return $this->addNode(new Text($text));
  }

  /**
   * Add a text node
   *
   * @param string $text The text value
   * @return Tag The text node
   */
  public function addTag(string $name, array $attributes = [], array $properties = []): Tag {
    return $this->addNode(new self($name, $attributes, $properties));
  }

  /**
   * Add a new node
   *
   * @param Node $node The node to add
   * @return Tag The node added
   */
  public function addNode(Node $node): Node {
    return $this->nodes[] = $node;
  }

  /**
   * Check if the tag has content
   *
   * @return bool The tag has content
   */
  public function hasContent(): bool {
    return !empty($this->nodes);
  }

  /**
   * Get the tag content
   *
   * @return string The tag content
   */
  public function getContent(): string {
    $content = '';
    foreach($this->nodes as $node)
      $content .= $node->render();
    return $content;
  }

  /**
   * Get the tag render
   *
   * @return string The tag render
   */
  public function render(): string {
    $render = "<{$this->name}";
    foreach($this->attributes as $name => $value) {
      $value = is_int(strpos($value, '"')) ? "'$value'" : "\"$value\"";
      $render .= " $name=$value";
    }
    return $render .= ($this->hasContent() || in_array($this->name, ['div', 'span']) ? ">{$this->getContent()}</{$this->name}>" : '/>');
  }

  /**
   * Add a tag dynamically
   *
   * @param string $name The tag name
   * @param array $args The tag parameters
   * @return Tag The tag added
   */
  public function __call(string $name, array $args): self {
    return $this->addTag($name, ...$args);
  }

  /**
   * Set an attribute dynamically
   *
   * @param string $name The attribute name
   * @param string $value The attribute value
   * @return void
   */
  public function __set(string $name, string $value) {
    $this->setAttribute($name, $value);
  }

  /**
   * Get an attribute dynamically
   *
   * @param string $name The attribute name
   * @return string $value The attribute value
   */
  public function __get(string $name): string {
    return $this->getAttribute($name);
  }

  /**
   * Check if the tag has an attribute dynamically
   *
   * @param string $name The attribute name
   * @return bool The tag has the attribute
   */
  public function __isset(string $name): bool {
    return $this->hasAttribute($name);
  }
}
