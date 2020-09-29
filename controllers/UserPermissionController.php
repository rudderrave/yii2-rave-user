<?php

namespace ravesoft\user\controllers;

use ravesoft\controllers\admin\BaseController;
use ravesoft\models\Permission;
use ravesoft\models\Role;
use ravesoft\models\User;
use Yii;
use yii\web\NotFoundHttpException;

class UserPermissionController extends BaseController
{

    /**
     * @param int $id User ID
     *
     * @throws \yii\web\NotFoundHttpException
     * @return string
     */
    public function actionSet($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            throw new NotFoundHttpException(Yii::t('rave/user', 'User not found'));
        }

        $permissionsByGroup = [];
        $permissions = Permission::find()
            ->andWhere([
                Yii::$app->rave->auth_item_table . '.name' => array_keys(Permission::getUserPermissions($user->id))
            ])
            ->joinWith('group')
            ->all();

        foreach ($permissions as $permission) {
            $permissionsByGroup[@$permission->group->name][] = $permission;
        }

        return $this->renderIsAjax('set', compact('user', 'permissionsByGroup'));
    }

    /**
     * @param int $id - User ID
     *
     * @return \yii\web\Response
     */
    public function actionSetRoles($id)
    {
        if (!Yii::$app->user->isSuperadmin AND Yii::$app->user->id == $id) {
            Yii::$app->session->setFlash('error', Yii::t('rave/user', 'You can not change own permissions'));
            return $this->redirect(['set', 'id' => $id]);
        }

        $oldAssignments = array_keys(Role::getUserRoles($id));

        // To be sure that user didn't attempt to assign himself some unavailable roles
        $newAssignments = array_intersect(Role::getAvailableRoles(Yii::$app->user->isSuperAdmin, true), Yii::$app->request->post('roles', []));

        $toAssign = array_diff($newAssignments, $oldAssignments);
        $toRevoke = array_diff($oldAssignments, $newAssignments);

        foreach ($toRevoke as $role) {
            User::revokeRole($id, $role);
        }

        foreach ($toAssign as $role) {
            User::assignRole($id, $role);
        }

        Yii::$app->session->setFlash('crudMessage', Yii::t('rave', 'Saved'));

        return $this->redirect(['set', 'id' => $id]);
    }

}
