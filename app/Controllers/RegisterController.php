<?php

namespace App\Controllers;

use App\Forms\User\RegisterForm;
use Somecode\Framework\Controller\AbstractController;
use Somecode\Framework\Http\Response;

class RegisterController extends AbstractController
{
    public function form(): Response
    {
        return $this->render('register.html.twig');
    }

    public function register()
    {
        // 1. Создайте модель формы, которая будет:

        $form = new RegisterForm;

        $form->setFields(
            $this->request->input('email'),
            $this->request->input('password'),
            $this->request->input('password_confirmation'),
            $this->request->input('name'),
        );

        if ($form->hasValidationErrors()) {

            dd($form->getValidationErrors());
        }

        // 2. Валидация
        // Если есть ошибки валидации, добавить в сессию и перенаправить на форму

        // 3. Зарегистрировать пользователя, вызвав $form->save()
        // 4. Добавить сообщение об успешной регистрации
        // 5. Войти в систему под пользователем
        // 6. Перенаправить на нужную страницу

    }
}
