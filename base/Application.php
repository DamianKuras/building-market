<?php  
namespace app\base;

use Exception;
use app\base\db\Database;
use app\base\db\DbModel;
use app\odels\CartForm;

class Application
{
    public string $layout='main';
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $db;
    public ?DbModel $user;
    public View $view;
    
    public function __construct($rootPath,array $config){
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request,$this->response);
        $this->view = new View();
        $this->db = new  Database($config['db']);
        $primaryValue = $this->session->get('user');
        $primaryKey = $this->userClass::primaryKey();
        if($primaryValue){
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
        }else{
            $this->user=null;
        }

    }
    public function run(){
        try{
            echo $this->router->resolve();
        }
        catch(Exception $e){
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('error', [
                'exception' => $e
            ]);
        }
        
    }

    public function login(DbModel $user){
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
    public function logout(){
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(){
        return !self::$app->user;
    }
    public static function isAdmin(){
        return self::$app->user->isAdmin();
    }
    public static function isUser(){
        return self::$app->user && !self::$app->user->isAdmin();
    }

    
}