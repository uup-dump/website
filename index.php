<?php
/*
Copyright 2020 whatever127

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

require_once 'api/listid.php';
require_once 'shared/style.php';

$buildsAvailable = 1;
$ids = uupListIds(null, 1);

if(isset($ids['error'])) {
    $buildsAvailable = 0;
}

$ids = $ids['builds'];

if(empty($ids)) {
    $buildsAvailable = 0;
}

// Below is the latest build that results in the most accurate 'latest retail' results in fetchupd.php?arch=XXX&ring=retail&build=XXX
$retailLatestBuild = "19041.330";

// Turns out in some cases a change from retail to beta will require two updates..
// This entire thing could be done recursively but the API doesn't support that.
$betaLatestBuild = "19042.330";

styleUpper('home');
?>

<div class="welcome-text">
    <p class="header"><?php echo $s['uupdump']; ?></p>
    <p class="sub"><i><?php echo $s['slogan']; ?></i></p>
</div>

<form class="ui form" action="known.php" method="get">
    <div class="field">
        <div class="ui big action input">
            <input type="text" name="q" placeholder="<?php echo $s['seachForBuilds']; ?>">
            <button class="ui big blue icon button" type="submit"><i class="search icon"></i></button>
        </div>
    </div>
</form>


<div class="quick-search-buttons">
    <i class="thumbtack icon"></i>

    <a class="ui mini button" href="known.php?q=regex:[2-9]\d{4}\.">
        <i class="search icon"></i>
        Dev Channel
    </a>

    <a class="ui mini button" href="known.php?q=19043">
        <i class="search icon"></i>
        21H1
    </a>

    <a class="ui mini button" href="known.php?q=19042">
        <i class="search icon"></i>
        20H2
    </a>
   
    <a class="ui mini button" href="known.php?q=19041">
        <i class="search icon"></i>
        20H1
    </a>

    <a class="ui mini button" href="known.php?q=18363">
        <i class="search icon"></i>
        19H2
    </a>

    <!-- Have you ever been so lazy to make something work properly in your
    code, so you implemented regex instead to make it work? -->
    <a class="ui mini button" href="known.php?q=regex:18362\.(?!\d{5})">
        <i class="search icon"></i>
        19H1
    </a>

    <a class="ui mini button" href="known.php?q=17763">
        <i class="search icon"></i>
        1809
    </a>
</div>

<h3 class="ui centered header">
    <div class="content">
        <i class="fitted rocket icon"></i>&nbsp;
        <?php echo $s['quickOptions']; ?>
    </div>
</h3>

<table class="ui large blue tablet stackable padded table">
    <thead>
        <tr>
            <th><?php echo $s['tHeadReleaseType']; ?></th>
            <th><?php echo $s['tHeadDescription']; ?></th>
            <th><?php echo $s['tHeadArchitectures']; ?></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="collapsing">
                <i class="large box icon"></i>
                <b><?php echo $s['latestPublicRelease']; ?></b>
            </td>
            <td><?php echo $s['latestPublicReleaseSub']; ?></td>
            <td class="center aligned collapsing">
                <a href="fetchupd.php?arch=amd64&ring=retail&build=<?php echo $retailLatestBuild; ?>"><button class="ui blue button">x64</button></a>
                <a href="fetchupd.php?arch=x86&ring=retail&build=<?php echo $retailLatestBuild; ?>"><button class="ui button">x86</button>
                <a href="fetchupd.php?arch=arm64&ring=retail&build=<?php echo $retailLatestBuild; ?>"><button class="ui button">arm64</button>
            </td>
        </tr>
        <tr>
            <td class="collapsing">
                <i class="large fire extinguisher icon"></i>
                <b><?php echo $s['latestRPRelease']; ?></b>
            </td>
            <td><?php echo $s['latestRPReleaseSub']; ?></td>
            <td class="center aligned">
                <a href="fetchupd.php?arch=amd64&ring=rp&build=<?php echo $retailLatestBuild; ?>"><button class="ui blue button">x64</button>
                <a href="fetchupd.php?arch=x86&ring=rp&build=<?php echo $retailLatestBuild; ?>"><button class="ui button">x86</button>
                <a href="fetchupd.php?arch=arm64&ring=rp&build=<?php echo $retailLatestBuild; ?>"><button class="ui button">arm64</button>
            </td>
        </tr>
        <tr>
            <td class="collapsing">
                <i class="large fire icon"></i>
                <b><?php echo $s['latestBetaRelease']; ?></b>
            </td>
            <td><?php echo $s['latestBetaReleaseSub']; ?></td>
            <td class="center aligned">
                <a href="fetchupd.php?arch=amd64&ring=wis&build=<?php echo $betaLatestBuild; ?>"><button class="ui blue button">x64</button>
                <a href="fetchupd.php?arch=x86&ring=wis&build=<?php echo $betaLatestBuild; ?>"><button class="ui button">x86</button>
                <a href="fetchupd.php?arch=arm64&ring=wis&build=<?php echo $betaLatestBuild; ?>"><button class="ui button">arm64</button>
            </td>
        </tr>
        <tr>
            <td class="collapsing">
                <i class="large bomb icon"></i>
                <b><?php echo $s['latestDevRelease']; ?></b>
            </td>
            <td><?php echo $s['latestDevReleaseSub']; ?></td>
            <td class="center aligned">
                <a href="fetchupd.php?arch=amd64&ring=wif&build=latest"><button class="ui blue button">x64</button></a>
                <a href="fetchupd.php?arch=x86&ring=wif&build=latest"><button class="ui button">x86</button></a>
                <a href="fetchupd.php?arch=arm64&ring=wif&build=latest"><button class="ui button">arm64</button></a>
            </td>
        </tr>
    </tbody>
</table>

<?php
if($buildsAvailable) {
    echo <<<EOD
<h3 class="ui centered header">
    <div class="content">
        <i class="fitted star outline icon"></i>&nbsp;
        ${s['newlyAdded']}
    </div>
</h3>

<table class="ui striped table">
    <thead>
        <tr>
            <th>${s['build']}</th>
            <th>${s['arch']}</th>
            <th>${s['dateAdded']}</th>
            <th>${s['updateid']}</th>
        </tr>
    </thead>
EOD;

    $i = 0;
    foreach($ids as $val) {
        $i++;
        if($i > 15) break;

        $arch = $val['arch'];
        if($arch == 'amd64') $arch = 'x64';

        echo '<tr><td>';
        echo '<i class="windows icon"></i>';
        echo '<a href="selectlang.php?id='.htmlentities($val['uuid']).'">'
             .htmlentities($val['title']).' '.htmlentities($val['arch'])."</a>";
        echo '</td><td>';
        echo htmlentities($arch);
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
    echo '</table>';
}

styleLower();
