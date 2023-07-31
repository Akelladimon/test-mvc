<?php
namespace Models;

require_once 'Models/Model.php';
class FormModel extends Model
{
    public const TABLE_NAME = 'user_form';

    public const ID_ATTRIBUTE = 'id';
    public const DESCRIPTION_ATTRIBUTE = 'description';
    public const TOKEN_ATTRIBUTE = 'csrf_token';

}