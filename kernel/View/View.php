<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exceptions\ViewNotFoundExceprion;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
        private StorageInterface $storage,
    )
    {
    }

    public function page(string $name, array $data = []): void
    {
        $viewPath = APP_PATH."/views/pages/$name.php";

        if(! file_exists($viewPath)){
            throw new ViewNotFoundExceprion("View $name not found");
        }

        extract(array_merge($this->defaultData(), $data));

        include_once $viewPath;
    }
    public function component(string $name): void
    {
        $componentPath = APP_PATH."/views/components/$name.php";
        if(! file_exists($componentPath)) {
            echo "Component $name not found";
            return;
        }
        extract($this->defaultData());
        include_once $componentPath;
    }
    private function defaultData(): array
    {
        return [
            'view'=> $this,
            'session' => $this->session,
            'auth' => $this->auth,
            'storage' => $this->storage,
        ];
    }
}