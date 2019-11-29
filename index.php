<?
// Session start
session_save_path(__DIR__ . DIRECTORY_SEPARATOR . '/data');
session_start();

// includes
require_once 'init/10_database.php';
require_once 'init/20_imports.php';

$controllerName = $_GET['c'] ?? 'pages';
$actionName = $_GET['a'] ?? 'start';

$controllerPath = __DIR__.'/controller/'.$controllerName.'_controller.php';

if(file_exists($controllerPath))
{
    require_once $controllerPath;

    $controllerClassName = '\\FSR_AI\\'.ucfirst($controllerName).'Controller';

    if(class_exists($controllerClassName))
    {
        $controllerInstance = new $controllerClassName($actionName, $controllerName);

        $actionMethodName = 'action'.ucfirst($actionName);

        if(method_exists($controllerInstance, $actionMethodName))
        {
            $controllerInstance->$actionMethodName();
            $controllerInstance->renderHTML();
        }
        else
        {
            echo $actionName;
           header('Location: index.php?c=pages&a=error4041');
        }
    }
    else
    {
        header('Location: index.php?c=pages&a=error4042');
    }

}
else
{
    header('Location: index.php?c=pages&a=error4043');
}
?>