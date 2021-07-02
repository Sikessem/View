<?php namespace Ends\Html;
/**
 * The text class
 *
 * @author SIGUI Kessé Emmanuel
 * @package sikessem/html
 * @license Apache-2.0
 */
class Text extends Node {
  /**
   * Create a new text
   *
   * @param string $value The text value
   */
  public function __construct(protected string $value){}

  /**
   * Get the text render
   *
   * @return string The text render
   */
  public function render(): string {
    return $this->value;
  }
}
