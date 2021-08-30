<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Extratos Controller
 *
 * @property \App\Model\Table\ExtratosTable $Extratos
 * @method \App\Model\Entity\Extrato[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ExtratosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Contas'],
        
        ];

        $key = $this->request->getQuery('key');
        if($key){
               $query = $this->Extratos->find('all',['conditions' => ['Extratos.tipo' => $key]]);
        }else{
            $query = $this->Extratos;
        }

        $extratos = $this->paginate($query);

        $this->set(compact('extratos'));
    }

    /**
     * View method
     *
     * @param string|null $id Extrato id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $extrato = $this->Extratos->get($id, [
            'contain' => ['Contas'],
        ]);

        $this->set(compact('extrato'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        
        $extrato = $this->Extratos->newEmptyEntity();
        if ($this->request->is('post')) {
            $extrato = $this->Extratos->patchEntity($extrato, $this->request->getData());
            if ($this->Extratos->save($extrato)) {
                $this->Flash->success(__('The extrato has been saved.'));

                return $this->redirect(['controller' => 'contas', 'action' => 'index']);
            }
            $this->Flash->error(__('The extrato could not be saved. Please, try again.'));
        }
        $contas = $this->Extratos->Contas->find('list', ['limit' => 200]);
        $groups = ['ENTRADA','SAIDA'];
        $this->set(compact('extrato', 'contas','groups'));
        // $this->set('groups', $this->Users->Groups->find('list')->all());
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Extrato id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $extrato = $this->Extratos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $extrato = $this->Extratos->patchEntity($extrato, $this->request->getData());
            if ($this->Extratos->save($extrato)) {
                $this->Flash->success(__('The extrato has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The extrato could not be saved. Please, try again.'));
        }
        $contas = $this->Extratos->Contas->find('list', ['limit' => 200]);
        $this->set(compact('extrato', 'contas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Extrato id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $extrato = $this->Extratos->get($id);
        if ($this->Extratos->delete($extrato)) {
            $this->Flash->success(__('The extrato has been deleted.'));
        } else {
            $this->Flash->error(__('The extrato could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function receitas()
     {
	$this->viewBuilder()->enableAutoLayout(false); 
	$extrato = $this->Extratos->find('all',['conditions'=>['Extratos.tipo' => 'ENTRADA'],'contain'=>['Contas']]);
	$this->viewBuilder()->setClassName('CakePdf.Pdf');
	$this->viewBuilder()->setOption(
		'pdfConfig',
		[
			'orientation' => 'portrait',
			'download' => true, // This can be omitted if "filename" is specified.
			'filename' => 'Receitas' . '.pdf' //// This can be omitted if you want file name based on URL.
		]
	);
	$this->set(compact('extrato'));
    }

    public function despesas()
     {
	$this->viewBuilder()->enableAutoLayout(false); 
	$extrato = $this->Extratos->find('all',['conditions'=>['Extratos.tipo' => 'SAIDA'],'contain'=>['Contas']]);
	$this->viewBuilder()->setClassName('CakePdf.Pdf');
	$this->viewBuilder()->setOption(
		'pdfConfig',
		[
			'orientation' => 'portrait',
			'download' => true, // This can be omitted if "filename" is specified.
			'filename' => 'Despesas' . '.pdf' //// This can be omitted if you want file name based on URL.
		]
	);
	$this->set('extrato', $extrato);
    }

    public function rd()
     {
	$this->viewBuilder()->enableAutoLayout(false); 
	$extrato = $this->Extratos->find('all',['contain'=>['Contas']]);
	$this->viewBuilder()->setClassName('CakePdf.Pdf');
	$this->viewBuilder()->setOption(
		'pdfConfig',
		[
			'orientation' => 'portrait',
			'download' => true, // This can be omitted if "filename" is specified.
			'filename' => 'Receitas e Despesas' . '.pdf' //// This can be omitted if you want file name based on URL.
		]
	);
	$this->set('extrato', $extrato);
    }

    public function export()
    {
        $this->setResponse($this->getResponse()->withDownload('Extratos.csv'));
        $header = ['id','Valor','Tipo','Conta','Created','Modified','Descrição'];
        $data = $this->Extratos->find('all');
        $this->set(compact('data'));
        $this->viewBuilder()
            ->setClassName('CsvView.Csv')
            ->setOptions([
                'serialize' => 'data',
                'header' => $header,
            ]);
    }
    

}
