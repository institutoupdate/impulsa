<?php
if( !function_exists('pll__')) {
    function pll__($str) {
      return __($str);
    }
}
if( !function_exists('pll_e')) {
    function pll_e($str) {
      return _e($str);
    }
}
