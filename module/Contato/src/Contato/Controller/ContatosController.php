<?php

namespace Contato\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ContatosController extends AbstractActionController {
    
    // GET / contato
    public function indexAction() {
        return array('message' => $this->getFlashMessenger());
    }
    
    // GET / contatos/novo
    public function novoAction(){
        return array('message' => $this->getFlashMessenger());
    }
    
    // POST / contatos/adicionar 
    public function adicionarAction(){
        //Obtém a requisicao
        $request = $this->getRequest();
        
        //Verifica se a requisicao é do tipo POST
        if($request->isPost()){
            //Obter e armazenar valores do POST
            $postData = $request->getPost()->toArray();
            $formularioValido = false;
            
            //Verifica se o formulário segue a validação proposta
            if($formularioValido){
                // aqui vai a lógica para adicionar os dados à tabela no banco
                // 1 - solicitar serviço para pegar o model responsável pela adição
                // 2 - inserir dados no banco pelo model
                
                //Adicionar mensagem de sucesso
                $this->flashMessenger()->addSuccessMessage("Contato criado com sucesso.");
                
                //Redirecionar para action index no controller contatos
                return $this->redirect()->toRoute('contatos');
            } else {
                //Adicionar mensagem de erro
                $this->flashMessenger()->addErrorMessage("Erro ao criar contato.");
                
                //Redireciona para action index no controller contatos
                return $this->redirect()->toRoute('contatos', array('action' => 'novo'));
            }
        }
    }
    
    // GET / contatos/detalhes/id
    public function detalhesAction(){
        //Filtra id passando pela url
        $id = (int) $this->params()->fromRoute('id', 0);
        
        // Se o id=0 ou não informado redireciona para os contatos
        if(!$id) {
            //Adiciona mensagem de erro
            $this->flashMessenger()->addErrorMessage("Contato não encontrado.");
            
            //Redireciona para action index
            return $this->redirect()->toRoute('contatos');
        }
        
        // aqui vai a lógica para pegar os dados referente ao contato
        // 1 - solicitar serviço para pegar o model responsável pelo find
        // 2 - solicitar form com dados desse contato encontrado

        // formulário com dados preenchidos
        $form = array (
            'nome'                => 'França',
            'telefone_principal'  => '11 2204-5154',
            'telefone_secundario' => '11 2204-5154',
            'data_criacao'        => '02/03/2013',
            'data_atualizacao'    => '02/03/2013',
        );
        
        return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger());
    }
    
    
    
    
    
    // GET / contatos/editar/id
    public function editarAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if(!$id){
            $this->flashMessenger()->addErrorMessage('Contato não encontrado');
            
            return $this->redirect()->toRoute('contatos');
        }
        
        
        $form = array(
            'nome'                => 'França',
            'telefone_principal'  => '11 2204-5154',
            'telefone_secundario' => '11 2204-5154',
        );
        
       return array('id' => $id, 'form' => $form, 'message' => $this->getFlashMessenger()); 
    }
    
    
    
    
    
    
    
    
    
    // POST / contatos/atualizar/id
    public function atualizarAction() {
        
        $request = $this->getRequest();
        
        if($request->isPost()){
            $postData = $request->getPost()->toArray();
            $formularioValido = true;
            
            if($formularioValido){
                $this->flashMessenger()->addSuccessMessage('Contato editado com sucesso');
                
                return $this->redirect()->toRoute('contatos', array('action' => 'detalhes', 'id' => $postData['id'],));
            } else {
                $this->flashMessenger()->addErrorMessage('Não foi possível editar o contato');
                
                return $this->redirect()->toRoute('contatos', array('action' => 'editar', 'id' => $postData['id'],));
            }
        }
    }
    
    
    
    
    // GET / contatos/deletar/id
    public function deletarAction(){
        
        $id = (int) $this->params()->fromRoute('id', 0);
        
        if(!$id) {
            $this->flashMessenger()->addErrorMessage('Contato não encontrado.');
        } else {
            
            $this->flashMessenger()->addSuccessMessage('ID '. $id .' foi deletado com sucesso.');
        }
        
        $this->redirect()->toRoute('contatos');
    }
    
    
    //Filter Flash Messenger
    private function getFlashMessenger(){
        $messenger = array();
        $flashMessenger = $this->flashMessenger();
        
        if($flashMessenger->hasSuccessMessages())
            $messenger['alert-success'] = array_shift ($flashMessenger->getSuccessMessages ());
        
        if($flashMessenger->hasErrorMessages())
            $messenger['alert-error'] = array_shift ($flashMessenger->getErrorMessages ());
        
        return $messenger;        
    }
}
?>
