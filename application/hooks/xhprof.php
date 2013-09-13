<?php 
class XHProf {
 
   private $XHProfPath = 'xhprof/';
   private $applicationName = 'my_application';
   private $sampleSize = 1;
   private static $enabled = false;
 
   public function XHProf_Start() {
      if (mt_rand(1, $this->sampleSize) == 1) {
         include_once $this->XHProfPath . 'xhprof_lib/utils/xhprof_lib.php';
         include_once $this->XHProfPath . 'xhprof_lib/utils/xhprof_runs.php';
         xhprof_enable(XHPROF_FLAGS_NO_BUILTINS + XHPROF_FLAGS_MEMORY + XHPROF_FLAGS_CPU );
 
         self::$enabled = true;
      }
   }
 
   public function XHProf_End() {
      if (self::$enabled) {
         $XHProfData = xhprof_disable();
    
         $XHProfRuns = new XHProfRuns_Default();
         $XHProfRuns->save_run($XHProfData, $this->applicationName);
      }
   }
 
}