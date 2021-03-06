<?php

namespace App\Services;

use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use Illuminate\Database\QueryException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Exception;
use Prettus\Validator\Exceptions\ValidatorException;

class InstitutionService
{
    private $repository;
    private $validator;

    public function __construct(InstitutionRepository $repository, InstitutionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $institution = $this->repository->create($data);

            $result['success'] = true;
            $result['messages'] = 'Instituição cadastrada.';
            $result['data'] = $institution;
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

    public function update($data, $id)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $institution = $this->repository->update($data, $id);

            $result['success'] = true;
            $result['messages'] = 'Instituição atualizada.';
            $result['data'] = $institution;
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
            $result['messages'] = 'Instituição removida.';
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