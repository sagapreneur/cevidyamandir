<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Minimal, dependency-free validator.
 * Rules: required, email, url, min:n, max:n, numeric, in:a,b,c
 */
final class Validator
{
    private array $errors = [];

    public function __construct(private array $data) {}

    public function validate(array $rules): bool
    {
        foreach ($rules as $field => $ruleString) {
            $value = trim((string) ($this->data[$field] ?? ''));
            foreach (explode('|', $ruleString) as $rule) {
                [$name, $param] = array_pad(explode(':', $rule, 2), 2, null);
                $this->applyRule($field, $value, $name, $param);
            }
        }
        return empty($this->errors);
    }

    private function applyRule(string $field, string $value, string $rule, ?string $param): void
    {
        switch ($rule) {
            case 'required':
                if ($value === '') $this->add($field, ucfirst($field) . ' is required.');
                break;
            case 'email':
                if ($value !== '' && !filter_var($value, FILTER_VALIDATE_EMAIL))
                    $this->add($field, 'Enter a valid email address.');
                break;
            case 'url':
                if ($value !== '' && !filter_var($value, FILTER_VALIDATE_URL))
                    $this->add($field, 'Enter a valid URL.');
                break;
            case 'numeric':
                if ($value !== '' && !is_numeric($value))
                    $this->add($field, ucfirst($field) . ' must be a number.');
                break;
            case 'min':
                if ($value !== '' && mb_strlen($value) < (int) $param)
                    $this->add($field, ucfirst($field) . " must be at least {$param} characters.");
                break;
            case 'max':
                if (mb_strlen($value) > (int) $param)
                    $this->add($field, ucfirst($field) . " may not exceed {$param} characters.");
                break;
            case 'in':
                $allowed = explode(',', (string) $param);
                if ($value !== '' && !in_array($value, $allowed, true))
                    $this->add($field, 'Invalid selection.');
                break;
        }
    }

    private function add(string $field, string $message): void
    {
        $this->errors[$field] ??= $message;
    }

    public function errors(): array { return $this->errors; }
    public function fails(): bool { return !empty($this->errors); }
}
