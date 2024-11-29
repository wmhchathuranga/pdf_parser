/*
Template Name: bitrate - Report Analysis Dashboard
Author: Bitrate
Version: 4.1.0
Website: https://Bitrate.com/
Contact: Bitrate@gmail.com
File: Common Plugins Js File
*/

//Common plugins
let scheme = window.location.protocol;
let hostname = window.location.hostname;

if(document.querySelectorAll("[toast-list]") || document.querySelectorAll('[data-choices]') || document.querySelectorAll("[data-provider]")){ 
  document.writeln("<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/toastify-js'></script>");
  document.writeln("<script type='text/javascript' src='"+ scheme +"//"+ hostname +"/build/libs/choices.js/public/assets/scripts/choices.min.js'></script>");
  document.writeln("<script type='text/javascript' src='"+ scheme +"//"+ hostname +"/build/libs/flatpickr/flatpickr.min.js'></script>");    
}