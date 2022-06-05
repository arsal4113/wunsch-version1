<%
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
%>

    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
        $this->loadComponent('Dashgum.SimpleSeach');
<% $belongsTo = $this->Bake->aliasExtractor($modelObj, 'BelongsTo'); %>
<% if ($belongsTo): %>
        $this->paginate = [
            'contain' => [<%= $this->Bake->stringifyList($belongsTo, ['indent' => false]) %>]
        ];
<% endif; %>
        if ($this->request->is('post')) {
            if(!empty($this->request->data['search_value']) && !empty($this->request->data['search_param'])) {
                $condition = $this->SimpleSeach->buildSeachConditions(
                    $this-><%= $currentModelName %>, $this->request->data['search_param'], $this->request->data['search_value']
                );
                $this->paginate['conditions'] = $condition;
            }
        }
        $this->set('availableColumns', $this-><%= $currentModelName %>->schema()->columns());
        $this->set('<%= $pluralName %>', $this->paginate($this-><%= $currentModelName %>));
        $this->set('_serialize', ['<%= $pluralName %>']);
    }
