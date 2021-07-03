<?php namespace SIKessEm\HTML;

/**
 * The HTML node class
 *
 * @author SIGUI Kessé Emmanuel
 * @package sikessem/html
 * @license Apache-2.0
 */
abstract class Node {
  /**
   * Get the node render
   *
   * @return string The node render
   */
  abstract public function render(): string;

  public function __toString(): string {
    return $this->render();
  }
}
