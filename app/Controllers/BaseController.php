<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use CodeIgniter\I18n\Time;

use App\Models\CustomerModel;
use App\Models\VendorModel;
use App\Models\ResetTokenModel;
use App\Models\LoginModel;
use App\Models\ProjectModel;
use App\Models\TimingModel;
use App\Models\CommentModel;
use App\Models\APIModel;
use App\Models\APILoginModel;


use \Firebase\JWT\JWT;
use CodeIgniter\RESTful\ResourceController;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        // E.g.: $this->session = \Config\Services::session();


        // Models
        helper('url');
        helper('form');
        $this->resetToken = new ResetTokenModel();
        $this->loginModel = new LoginModel();
        $this->customerModel = new CustomerModel();
        $this->vendorModel = new VendorModel();
        $this->commentModel = new CommentModel();
        $this->timingModel = new TimingModel();
        $this->projectModel = new ProjectModel();
    }
}
