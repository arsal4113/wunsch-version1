<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-4">
		<h2><?= __('Roles Permissions') ?></h2>
		<ol class="breadcrumb">
			<li><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['controller'])) ?></li>
			<li class="active"><strong><?= \Cake\Utility\Inflector::humanize(\Cake\Utility\Inflector::underscore($this->request->params['action'])) ?></strong></li>
		</ol>
	</div>
    <div class="col-sm-8">
        <div class="title-action">
            <?= $this->Html->link('<i class="fa fa-refresh"></i>' . ' ' . __('Syncronize controllers & actions'), ['controller' => 'Acos', 'action' => 'syncControllersActions', 'plugin' => 'AclManager', 'admin' => false], ['class' => 'btn btn-sm btn-primary', 'escape' => false]) ?>
        </div>
    </div>
</div>


<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <?= $this->Form->create(null, ['class' => 'form-inline aro-form']) ?>
                    <div class="input-group" style="margin-top: -5px">
                        <?= $this->Form->input('core_user_role_id', ['class' => 'form-control', 'options' => $coreUserRoleList, 'empty' => false, 'label' => false]) ?>
                    </div>
                    <div class="input-group">
                        <?= $this->Form->input('plugin', ['class' => 'acl-plugin-input form-control', 'options' => $plugins, 'empty' => false, 'label' => false]) ?>
                        <span class="input-group-btn">

						<button class="btn btn-info aro-search-button" type="submit"><?= __('Search') ?></button>
					</span>
                    </div>
                    <?= $this->Form->end()?>


                    <div class="hr-line-dashed"></div>

                    <table class="table table-bordered table-striped table-condensed">
                        <thead>
                        <tr>
                            <th><?= __('Action') ?></th>
                            <?php
                            $columnCount = 1;
                            foreach ($coreUserRoles as $coreUserRole) {
                                echo "<th class=\"text-center\">" . __($coreUserRole->code) . "</th>";
                                $columnCount++;
                            }
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if(isset($methods)) {
                            debug($methods);

                            foreach($methods as $plugin => $pluginMethods) {
                                //debug($methods);die;
                                if(!empty($pluginMethods)) {
                                    echo "<tr>";
                                    echo "<td class=\"td-divider\" colspan=\"" . $columnCount . "\">";
                                    echo "<strong>" . $plugin . "</strong>";
                                    debug($plugin);
                                   // debug($pluginMethods);
                                    echo "</td>";
                                    echo "</tr>";
                                    foreach($pluginMethods as $controller => $actions) {
                                        debug($controller);
                                        foreach($actions as $action) {

                                            $actionName = $controller . "/" . $action['name'];
                                            if($plugin != 'Core') {
                                                $actionName = $plugin . "/" . $controller . "/" . $action['name'];
                                            }

                                            echo "<tr>";
                                            echo "<td>";
                                            echo $controller . " > " . $action['name'];
                                            echo "</td>";
                                            foreach ($coreUserRoles as $coreUserRole) {
                                                echo "<td class=\"text-center\" id=\"" . $coreUserRole->id . '-' . $controller . "-" . $action['name'] . "\">";
                                                $icon = '<i class="fa fa-remove"></i>';
                                                $permission = 0;
                                                if(isset($permissions[$coreUserRole->id][$actionName]) && $permissions[$coreUserRole->id][$actionName] == 1) {
                                                    $icon = '<i class="fa fa-check"></i>';
                                                    $permission = 1;
                                                }

                                                echo $this->Html->link($icon, '#', [
                                                    'escape' => false,
                                                    'onclick' => "setPermission(this); return false",
                                                    'data-user-role-id' => $coreUserRole->id,
                                                    'data-controller' => $controller,
                                                    'data-action-name' => $action['name'],
                                                    'data-action' => $controller . "/" . $action['name'],
                                                    'data-permission' => $permission
                                                ]);
                                                echo "</td>";

                                            }
                                            echo "</tr>";
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan=\"" . $columnCount . "\">" . $plugin . __(' does not have any function') . "</td></tr>";
                                }
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	function setPermission(identifier) {
		var userRoleId = $(identifier).data('user-role-id');
		var controller = $(identifier).data('controller');
		var actionName = $(identifier).data('action-name');
		var action = $(identifier).data('action');
		var permission = $(identifier).data('permission');

		if(permission == 0) {
			var newPermission = 1;
			var content = '<a data-permission="1" data-action="' + action + '" data-action-name="' + actionName + '" data-controller="' + controller + '" data-user-role-id="' + userRoleId + '" onclick="setPermission(this); return false;" href="#"><i class="fa fa-check"></i></a>';
		} else {
			var newPermission = 0;
			var content = '<a data-permission="0" data-action="' + action + '" data-action-name="' + actionName + '" data-controller="' + controller + '" data-user-role-id="' + userRoleId + '" onclick="setPermission(this); return false;" href="#"><i class="fa fa-remove"></i></a>';
		}

		$.ajax({
			type: "POST",
			url: "/acl_manager/Aros/setPermission",
			data: "userRoleId=" + userRoleId + "&action=" + action + "&permission=" + newPermission,
			success: function(data){
				$("#" + userRoleId + "-" + controller + "-" + actionName).html(content);
			}
		});

		return false; 
	}
</script>