<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\Validators\GroupValidator;
use Exception;
use Illuminate\Database\QueryException;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Validator\Contracts\ValidatorInterface;

class GroupService
{
    private $repository;
    private $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $group = $this->repository->create($data);

            $result['success'] = true;
            $result['messages'] = 'Grupo cadastrado.';
            $result['data'] = $group;
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

    public function userStore($group_id, $data)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $group = $this->repository->find($group_id);
            $user_id = $data['user_id'];

            $group->users()->attach($user_id);

            $result['success'] = true;
            $result['messages'] = 'Usuário relacionado com sucesso!';
            $result['data'] = $group;
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

    public function delete($institution_id)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->repository->destroy($institution_id);

            $result['success'] = true;
            $result['messages'] = 'Grupo removido.';
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