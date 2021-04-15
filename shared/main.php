<?php
/*
Copyright 2021 whatever127

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

   http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
*/

// Website information
$websiteVersion = '3.44.2';
$requiredApi = '1.30.0';

require_once dirname(__FILE__).'/../api/shared/main.php';
require_once dirname(__FILE__).'/utils.php';
require_once dirname(__FILE__).'/lang.php';

// Do check of API
checkApi();
