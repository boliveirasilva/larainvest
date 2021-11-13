<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Exception;

class ProductService
{
    private $repository;
    private $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function store($data)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $product = $this->repository->create($data);

            $result['success'] = true;
            $result['messages'] = 'Produto cadastrado.';
            $result['data'] = $product;
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
            $product = $this->repository->update($data, $id);

            $result['success'] = true;
            $result['messages'] = 'Produto atualizado.';
            $result['data'] = $product;
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

    public function delete($product_id)
    {
        $result = ['success' => false, 'messages' => 'Erro de execução'];

        try {
            $this->repository->destroy($product_id);

            $result['success'] = true;
            $result['messages'] = 'Produto removido.';
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