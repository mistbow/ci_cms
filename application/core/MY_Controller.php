<?php

class MY_Controller extends CI_Controller {

	protected $view = '';

	protected $data = array();

	protected $layout;

	protected $asides = array();

	protected $models = array();

	protected $model_string = '%_model';

	protected $helpers = array();

	public function __construct() {
		parent::__construct();
		$this -> data['errors'] = array();
		$this -> data['site_name'] = config_item('site_name');
		$this -> _load_models();
		$this -> _load_helpers();
	}

	public function _remap($method) {
		if (method_exists($this, $method)) {
			call_user_func_array(array($this, $method), array_slice($this -> uri -> rsegments, 2));
		} else {
			if (method_exists($this, '_404')) {
				call_user_func_array(array($this, '_404'), array($method));
			} else {
				show_404(strtolower(get_class($this)) . '/' . $method);
			}
		}

		$this -> _load_view();
	}

	/**
	 * Automatically load the view, allowing the developer to override if
	 * he or she wishes, otherwise being conventional.
	 */
	protected function _load_view() {
		// If $this->view == FALSE, we don't want to load anything
		if ($this -> view !== FALSE) {
			// If $this->view isn't empty, load it. If it isn't, try and guess based on the controller and action name
			$view = (!empty($this -> view)) ? $this -> view : $this -> router -> directory . $this -> router -> class . '/' . $this -> router -> method;

			// Load the view into $yield
			$data['yield'] = $this -> load -> view($view, $this -> data, TRUE);

			// Do we have any asides? Load them.
			if (!empty($this -> asides)) {
				foreach ($this->asides as $name => $file) {
					$data['yield_' . $name] = $this -> load -> view($file, $this -> data, TRUE);
				}
			}

			// Load in our existing data with the asides and view
			$data = array_merge($this -> data, $data);
			$layout = FALSE;

			// If we didn't specify the layout, try to guess it
			if (!isset($this -> layout)) {
				if (file_exists(APPPATH . 'views/layouts/' . $this -> router -> class . '.php')) {
					$layout = 'layouts/' . $this -> router -> class;
				} else {
					$layout = 'layouts/application';
				}
			}

			// If we did, use it
			else if ($this -> layout !== FALSE) {
				$layout = $this -> layout;
			}

			// If $layout is FALSE, we're not interested in loading a layout, so output the view directly
			if ($layout == FALSE) {
				$this -> output -> set_output($data['yield']);
			}

			// Otherwise? Load away :)
			else {
				$this -> load -> view($layout, $data);
			}
		}
	}

	/* --------------------------------------------------------------
	 * MODEL LOADING
	 * ------------------------------------------------------------ */

	/**
	 * Load models based on the $this->models array
	 */
	private function _load_models() {
		foreach ($this->models as $model) {
			$this -> load -> model($this -> _model_name($model), $model);
		}
	}

	/**
	 * Returns the loadable model name based on
	 * the model formatting string
	 */
	protected function _model_name($model) {
		return str_replace('%', $model, $this -> model_string);
	}

	/* --------------------------------------------------------------
	 * HELPER LOADING
	 * ------------------------------------------------------------ */

	/**
	 * Load helpers based on the $this->helpers array
	 */
	private function _load_helpers() {
		foreach ($this->helpers as $helper) {
			$this -> load -> helper($helper);
		}
	}

}
