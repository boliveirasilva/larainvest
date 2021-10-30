<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class UserService
{
    private $repository;
    private $validator;

    public function __construct(UserRepository $repository, UserValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $user = $this->repository->create($data);

            $result['success'] = true;
            $result['messages'] = 'Usuário cadastrado.';
            $result['data'] = $user;
        } catch (ValidatorException $ex) {
            // Tratamento de erro | atualização do retorno se necessário.
            $result['messages'] = $ex->getMessageBag()->getMessages();

            $result['flash_message'] = '<ul>';
            foreach ($result['messages'] as $item => $message) {
                $result['flash_message'] .= sprintf('<li>%s: %s</li>', $item, implode('|', $message));
            }
            $result['flash_message'] .= '</ul>';
        } catch (Exception $ex) {
            // Tratamento de erro | atualização do retorno se necessário.
            $result['messages'] = $ex->getMessage();
        } finally {
            return $result;
        }
    }

    public function delete($user_id)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->repository->destroy($user_id);

            $result['success'] = true;
            $result['messages'] = 'Usuário removido.';
            $result['data'] = null;
        } catch (ValidatorException $ex) {
            // Tratamento de erro | atualização do retorno se necessário.
            $result['messages'] = $ex->getMessageBag()->getMessages();

            $result['flash_message'] = '<ul>';
            foreach ($result['messages'] as $item => $message) {
                $result['flash_message'] .= sprintf('<li>%s: %s</li>', $item, implode('|', $message));
            }
            $result['flash_message'] .= '</ul>';
        } catch (Exception $ex) {
            // Tratamento de erro | atualização do retorno se necessário.
            $result['messages'] = $ex->getMessage();
        } finally {
            return $result;
        }
    }
}