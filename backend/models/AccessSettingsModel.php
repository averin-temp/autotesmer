<?php

namespace app\models;

use yii\base\Model;
use yii\rbac\Role;

class AccessSettingsModel extends Model
{

    public $role;
    public $name;
    public $description;
    public $permissions;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $permissions = \Yii::$app->authManager->getPermissions();
        foreach($permissions as $permission){
            $this->permissions[$permission->name] = 0;
        }
    }

    /**
     * @param $role Role
     */
    public function loadRole($role){

        $this->role = $role;
        $this->name = $role->name;
        $this->description = $role->description;

        $permissions = \Yii::$app->authManager->getPermissionsByRole($role->name);

        foreach($permissions as $permission){
            $this->permissions[$permission->name] = 1;
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->permissions[$name];
    }


    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)
    {
        $loaded = false;

        if(!empty($data['name'])){
            $loaded = true;
            $this->name = trim($data['name']);
        }

        if(!empty($data['description'])){
            $loaded = true;
            $this->description = trim($data['description']);
        }

        foreach($data as $key => $value){
            if(isset($this->permissions[$key])){
                $this->permissions[$key] = 1;
                $loaded = true;
            }
        }

        return $loaded;
    }

    /**
     * @param null $attributeNames
     * @param bool $clearErrors
     * @return bool
     */
    public function validate($attributeNames = null, $clearErrors = true){

        if(empty($this->name)){
            $this->addError('name', 'Укажите имя роли');
        }

        if($this->role === null){
            $role = \Yii::$app->authManager->getRole($this->name);
            if($role) $this->addError('name', "Роль с таким именем уже существует");
        }

        if(empty($this->description)){
            $this->addError('description', 'Укажите описание роли');
        }

        return empty($this->hasErrors());
    }

    /**
     * @throws \yii\base\Exception
     */
    public function save(){

        if(!$this->validate()){
            return false;
        }

        $authManager = \Yii::$app->authManager;

        if($this->role == null){
            $this->role = $authManager->createRole($this->name);
            $this->role->description = $this->description;
            $authManager->add($this->role);
        } else {
            $this->role->name = $this->name;
            $this->role->description = $this->description;
            $authManager->update($this->role->name, $this->role);
        }



        $authManager->removeChildren($this->role);

        $dependencies = self::getAccessDependencies();
        $permissions = $this->getPermissionsRecursive($dependencies);

        foreach($permissions as $permissionName){
            $permission = $authManager->getPermission($permissionName);
            $authManager->addChild($this->role, $permission);
        }

        return true;
    }




    public function clearValues(){
        foreach($this->permissions as $permisstion => &$value){
            $value = 0;
        }
    }

    /**
     * @param $list
     * @return array
     */
    public function getPermissionsRecursive($list){

        if(!is_array($list)) return [];

        $permissions = [];
        foreach($list as $permission => $children){
            $children_permissions = $this->getPermissionsRecursive($children);
            if(!empty($children_permissions)){
                $permissions = array_merge($children_permissions, $permissions);
            } elseif($this->permissions[$permission] == 1) {
                array_push($permissions, $permission);
            }
        }

        return $permissions;
    }


    public static function getAccessDependencies(){
        return [
            'accessBackend' => [
                'accessArbitrage' => [ 'editArbitrage' => '' ],
                'accessBanners' => ['editBanners' => '' ],
                'accessCategories' => ['editCategories' => '' ],
                'accessGroups' => ['editGroups' => '' ],
                'accessMailing' => ['editMailing' => '' ],
                'accessMailTemplates' => ['editMailTemplates' => '' ],
                'accessMenu' => ['editMenu' => '' ],
                'accessPackages' => ['editPackages' => '' ],
                'accessPages' => ['editPages' => '' ],
                'accessPromocodes' => ['editPromocodes' => '' ],
                'accessRoles' => ['editRoles' => '' ],
                'accessUsers' => ['editUsers' => '' ],
                'accessVerifications' => ['editVerifications' => '' ],
            ],
            'accessLK'  => '' ,
        ];
    }


}