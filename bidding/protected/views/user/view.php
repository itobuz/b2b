<?php
$this->breadcrumbs = array(
    'Users' => array('index'),
    $model->username,
);
if (Yii::app()->user->checkAccess('Admin')) {
    $this->layout = '//layouts/column2';
    $this->menu = array(
        array('label' => 'List User', 'url' => array('index')),
        array('label' => 'Create User', 'url' => array('create')),
        array('label' => 'Update User', 'url' => array('update', 'id' => $model->id)),
        array('label' => 'Delete User', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
        array('label' => 'Manage User', 'url' => array('admin')),
    );
}
?>

<h1>View User: <?php echo $model->username; ?></h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'address1',
        'address2',
        array('name' => 'city',
            'value' => ucfirst(City::model()->getNameById($model->city))),
        array('name' => 'state',
            'value' => ucfirst(State::model()->getNameById($model->state))),
        'pincode',
        'cellphone',
        'landline',
        'fax',
        'email',
        'panId',
        'companyName',
        'companyForm',
        'yearEstablished',
        'registrationNumber',
        'issuingAuthority',
        'ownerName',
        'userType',
        'rstCst',
        'beatAccountNumber',
        'businessType',
        'tradeCapacity',
    ),
));
?>
