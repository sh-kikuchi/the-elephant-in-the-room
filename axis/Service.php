<?php

namespace app\axis;

use app\axis\Template;
use app\axis\toolbox\Session;

/**
 * Class Service
 *
 * Provides various utility methods for managing sessions, CSRF tokens, and rendering templates.
 */
class Service {

    public function __construct() {
        $session  = new Session;
    }

    /**
     * Generate a CSRF token for a specified form.
     *
     * @param string $form_name The name of the form for which the token is being generated.
     * @return string The generated CSRF token.
     */
    function setToken(string $form_name): string {
        $csrf_token = bin2hex(random_bytes(32));
        $_SESSION['csrf_token'][$form_name] = $csrf_token;

        return $csrf_token;
    }

    /**
     * Check if the provided CSRF token is valid for a specified form.
     *
     * @param string $form_name The name of the form to check the token against.
     * @return bool True if the token is valid, false otherwise.
     */
    function checkToken(string $form_name): bool {
        if (!isset($_SESSION['csrf_token'][$form_name])) {
            return false;
        }

        return $_POST["csrf_token"] === $_SESSION['csrf_token'][$form_name];
    }

    /**
     * Render a template file.
     *
     * @return mixed The rendered template output.
     */
    function render(): mixed {
        $template = new Template;

        return $template->render();
    }
}
