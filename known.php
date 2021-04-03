<?php
/*
Copyright 2019 whatever127

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

$search = isset($_GET['q']) ? $_GET['q'] : null;

require_once 'api/listid.php';
require_once 'shared/style.php';
$ids = uupListIds($search);
if(isset($ids['error'])) {
    fancyError($ids['error'], 'downloads');
    die();
}

$ids = $ids['builds'];

if(empty($ids)) {
    fancyError('NO_BUILDS_IN_FILEINFO', 'downloads');
    die();
}

if($search) {
    $pageTitle = "$search - {$s['browseKnown']}";
} else {
    $pageTitle = $s['browseKnown'];
}

styleUpper('downloads', $pageTitle);
?>

<h3 class="ui centered header">
    <div class="content">
        <i class="fitted shopping basket icon"></i>&nbsp;
        <?php echo $s['browseKnown']; ?>
    </div>
</h3>

<div class="ui top attached segment">
    <form class="ui form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <div class="field">
            <div class="ui big action input">
                <input type="text" name="q" value="<?php echo htmlentities($search); ?>" placeholder="<?php echo $s['seachForBuilds']; ?>">
                <button class="ui big blue icon button" type="submit"><i class="search icon"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="ui bottom attached success message">
    <i class="search icon"></i>
    <?php printf($s['weFoundBuilds'], count($ids)); ?>
</div>

<table class="ui celled striped table">
    <thead>
        <tr>
            <th><?php echo $s['build']; ?></th>
            <th><?php echo $s['arch']; ?></th>
            <th><?php echo $s['dateAdded']; ?></th>
            <th><?php echo $s['updateid']; ?></th>
        </tr>
    </thead>
<?php
foreach($ids as $val) {
    $arch = $val['arch'];
    if($arch == 'amd64') $arch = 'x64';

    echo '<tr><td>';
    echo '<i class="windows icon"></i>';
    echo '<a href="./selectlang.php?id='.htmlentities($val['uuid']).'">'
         .htmlentities($val['title']).' '.htmlentities($val['arch'])."</a>";
    echo '</td><td>';
    echo $arch;
    echo '</td><td>';
    if($val['created'] == null) {
       echo 'Unknown';
    } else {
       echo date("Y-m-d H:i:s T", $val['created']);
    }
    echo '</td><td>';
    echo '<code>'.htmlentities($val['uuid']).'</code>';
    echo "</td></tr>\n";
}
?>
</table>

<?php
styleLower();
?>
