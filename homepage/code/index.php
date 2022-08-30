<?php
    $dcs = "http://dcs";
    $door43_preview = "https://dev.door43.org";
    $d43_enqueue = "http://localhost:" . $_ENV["DOOR43_ENQUEUE_JOB_PROXY_PORT"];
    $tx_enqueue = "http://localhost:" . $_ENV["TX_ENQUEUE_JOB_PROXY_PORT"];
?>
<html>
    <head>
        <title>tX Links & Forms</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </head>
    <body>
<TABLE BORDER=1>
    <TR>
        <TD>DCS:</TD><TD><a href="<?php echo $dcs?>" target="_blank"><?php echo $dcs?></a><br>Be sure to <a href="https://medium.com/@anaidyonov/how-to-run-gitea-on-os-x-f5eaf726083e">set up your system</a> for dcs host</TD>
    </TR>
    <TR>
        <TD>Door43 Preview:</TD><TD><a href="<?php echo $door43_preview?>" target="_blank"><?php echo $door43_preview?></a></TD>
    </TR>
    <TR>
        <TD>D43 Enqueue:</TD><TD><a href="<?php echo $d43_enqueue?>" target="_blank"><?php echo $d43_enqueue?></a></TD>
    </TR>
    <TR>
        <TD>TX Enqueue:</TD><TD><a href="<?php echo $tx_enqueue?>" target="_blank"><?php echo $tx_enqueue?></a></TD>
    </TR>
</TABLE>

<textarea id="push">
{
  "ref": "refs/heads/master",
  "before": "fc98fb9266c4291ed510a32a94fa626c254a1ccc",
  "after": "a20576286edc5928947c59a1f7f09ebf944bfd34",
  "compare_url": "http://dcs/root/en_obs/compare/fc98fb9266c4291ed510a32a94fa626c254a1ccc...a20576286edc5928947c59a1f7f09ebf944bfd34",
  "commits": [
    {
      "id": "a20576286edc5928947c59a1f7f09ebf944bfd34",
      "message": "Update 'LICENSE.md'\n",
      "url": "http://dcs/root/en_obs/commit/a20576286edc5928947c59a1f7f09ebf944bfd34",
      "author": {
        "name": "root",
        "email": "root@localhost",
        "username": "root"
      },
      "committer": {
        "name": "root",
        "email": "root@localhost",
        "username": "root"
      },
      "verification": null,
      "timestamp": "2022-03-15T04:28:26-06:00",
      "added": [],
      "removed": [],
      "modified": [
        "LICENSE.md"
      ]
    }
  ],
  "head_commit": {
    "id": "a20576286edc5928947c59a1f7f09ebf944bfd34",
    "message": "Update 'LICENSE.md'\n",
    "url": "http://dcs/root/en_obs/commit/a20576286edc5928947c59a1f7f09ebf944bfd34",
    "author": {
      "name": "root",
      "email": "root@localhost",
      "username": "root"
    },
    "committer": {
      "name": "root",
      "email": "root@localhost",
      "username": "root"
    },
    "verification": null,
    "timestamp": "2022-03-15T04:28:26-06:00",
    "added": [],
    "removed": [],
    "modified": [
      "LICENSE.md"
    ]
  },
  "repository": {
    "id": 17,
    "owner": {
      "id": 1,
      "login": "root",
      "full_name": "",
      "email": "root@localhost",
      "avatar_url": "http://dcs/avatar/b1a4b2518dbbdd47dd4a713d5cd1df94",
      "language": "",
      "is_admin": false,
      "last_login": "0001-01-01T00:00:00Z",
      "created": "2021-05-29T07:45:33-06:00",
      "repo_languages": null,
      "repo_subjects": null,
      "restricted": false,
      "active": false,
      "prohibit_login": false,
      "location": "",
      "website": "",
      "description": "",
      "visibility": "public",
      "followers_count": 0,
      "following_count": 0,
      "starred_repos_count": 0,
      "username": "root"
    },
    "name": "en_obs",
    "full_name": "root/en_obs",
    "description": "",
    "empty": false,
    "private": false,
    "fork": true,
    "template": false,
    "parent": {
      "id": 5,
      "owner": {
        "id": 2,
        "login": "unfoldingWord",
        "full_name": "",
        "email": "",
        "avatar_url": "http://dcs/avatars/0e149654732c1d8587f83d44559cea37",
        "language": "",
        "is_admin": false,
        "last_login": "0001-01-01T00:00:00Z",
        "created": "2021-05-29T07:45:41-06:00",
        "repo_languages": null,
        "repo_subjects": null,
        "restricted": false,
        "active": false,
        "prohibit_login": false,
        "location": "",
        "website": "",
        "description": "",
        "visibility": "public",
        "followers_count": 0,
        "following_count": 0,
        "starred_repos_count": 0,
        "username": "unfoldingWord"
      },
      "name": "en_obs",
      "full_name": "unfoldingWord/en_obs",
      "description": "",
      "empty": false,
      "private": false,
      "fork": false,
      "template": false,
      "parent": null,
      "mirror": false,
      "size": 735,
      "html_url": "http://dcs/unfoldingWord/en_obs",
      "ssh_url": "git@dcs:unfoldingWord/en_obs.git",
      "clone_url": "http://dcs/unfoldingWord/en_obs.git",
      "original_url": "https://git.door43.org/unfoldingword/en_obs",
      "website": "",
      "stars_count": 0,
      "forks_count": 2,
      "watchers_count": 2,
      "open_issues_count": 0,
      "open_pr_counter": 0,
      "release_counter": 5,
      "default_branch": "master",
      "archived": false,
      "created_at": "2021-07-01T11:01:15-06:00",
      "updated_at": "2021-07-01T11:02:06-06:00",
      "permissions": {
        "admin": true,
        "push": true,
        "pull": true
      },
      "has_issues": true,
      "internal_tracker": {
        "enable_time_tracker": true,
        "allow_only_contributors_to_track_time": true,
        "enable_issue_dependencies": true
      },
      "has_wiki": true,
      "has_pull_requests": true,
      "has_projects": true,
      "ignore_whitespace_conflicts": false,
      "allow_merge_commits": true,
      "allow_rebase": true,
      "allow_rebase_explicit": true,
      "allow_squash_merge": true,
      "default_merge_style": "merge",
      "avatar_url": "http://dcs/repo-avatars/5-c99b42b671402512da635102b31c76ad",
      "internal": false,
      "language": "en",
      "subject": "Open Bible Stories",
      "books": [
        "obs"
      ],
      "title": "unfoldingWord® Open Bible Stories",
      "checking_level": "3",
      "catalog": null,
      "mirror_interval": "",
      "mirror_updated": "0001-01-01T00:00:00Z",
      "repo_transfer": null
    },
    "mirror": false,
    "size": 735,
    "html_url": "http://dcs/root/en_obs",
    "ssh_url": "git@dcs:root/en_obs.git",
    "clone_url": "http://dcs/root/en_obs.git",
    "original_url": "",
    "website": "",
    "stars_count": 0,
    "forks_count": 0,
    "watchers_count": 1,
    "open_issues_count": 0,
    "open_pr_counter": 0,
    "release_counter": 0,
    "default_branch": "master",
    "archived": false,
    "created_at": "2022-03-15T04:28:01-06:00",
    "updated_at": "2022-03-15T04:28:01-06:00",
    "permissions": {
      "admin": true,
      "push": true,
      "pull": true
    },
    "has_issues": true,
    "internal_tracker": {
      "enable_time_tracker": true,
      "allow_only_contributors_to_track_time": true,
      "enable_issue_dependencies": true
    },
    "has_wiki": true,
    "has_pull_requests": true,
    "has_projects": true,
    "ignore_whitespace_conflicts": false,
    "allow_merge_commits": true,
    "allow_rebase": true,
    "allow_rebase_explicit": true,
    "allow_squash_merge": true,
    "default_merge_style": "merge",
    "avatar_url": "",
    "internal": false,
    "language": "en",
    "subject": "Open Bible Stories",
    "books": [
      "obs"
    ],
    "title": "unfoldingWord® Open Bible Stories",
    "checking_level": "3",
    "catalog": null,
    "mirror_interval": "",
    "mirror_updated": "0001-01-01T00:00:00Z",
    "repo_transfer": null
  },
  "pusher": {
    "id": 1,
    "login": "root",
    "full_name": "",
    "email": "root@localhost",
    "avatar_url": "http://dcs/avatar/b1a4b2518dbbdd47dd4a713d5cd1df94",
    "language": "",
    "is_admin": false,
    "last_login": "0001-01-01T00:00:00Z",
    "created": "2021-05-29T07:45:33-06:00",
    "repo_languages": null,
    "repo_subjects": null,
    "restricted": false,
    "active": false,
    "prohibit_login": false,
    "location": "",
    "website": "",
    "description": "",
    "visibility": "public",
    "followers_count": 0,
    "following_count": 0,
    "starred_repos_count": 0,
    "username": "root"
  },
  "sender": {
    "id": 1,
    "login": "root",
    "full_name": "",
    "email": "root@localhost",
    "avatar_url": "http://dcs/avatar/b1a4b2518dbbdd47dd4a713d5cd1df94",
    "language": "",
    "is_admin": false,
    "last_login": "0001-01-01T00:00:00Z",
    "created": "2021-05-29T07:45:33-06:00",
    "repo_languages": null,
    "repo_subjects": null,
    "restricted": false,
    "active": false,
    "prohibit_login": false,
    "location": "",
    "website": "",
    "description": "",
    "visibility": "public",
    "followers_count": 0,
    "following_count": 0,
    "starred_repos_count": 0,
    "username": "root"
  }
}
</textarea>
<input type="submit" id="submit" />
</body>

<script>
$(document).ready(function() {
    $('#submit').click(function() {
        console.log($("#push").val());
        $.ajax({
            url: "<?php echo $d43_enqueue?>",
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-GitHub-Delivery", "db4a47d3-6e47-42f9-abfa-e8d7a08ca596");
                xhr.setRequestHeader("X-GitHub-Event", "push");
                xhr.setRequestHeader("X-GitHub-Event-Type", "push");
                xhr.setRequestHeader("X-Gitea-Delivery", "db4a47d3-6e47-42f9-abfa-e8d7a08ca596");
                xhr.setRequestHeader("X-Gitea-Event", "push");
                xhr.setRequestHeader("X-Gitea-Event-Type", "push");
                xhr.setRequestHeader("X-Gitea-Signature", "");
                xhr.setRequestHeader("X-Gogs-Delivery", "db4a47d3-6e47-42f9-abfa-e8d7a08ca596");
                xhr.setRequestHeader("X-Gogs-Event", "push");
                xhr.setRequestHeader("X-Gogs-Event-Type", "push");
                xhr.setRequestHeader("X-Gogs-Signature", "");
                xhr.setRequestHeader("X-Hub-Signature", "sha1=");
                xhr.setRequestHeader("X-Hub-Signature-256", "sha256=");
            }, 
            type: 'POST', 
            dataType: 'json', 
            contentType: 'application/json', 
            processData: false,

            data: {
                serial: $("#push").val(),
            }, 

            success: function (data) {
                alert(JSON.stringify(data));
            }, 
            error: function(error){ 
                alert("Cannot get data");
                console.log(error);
            } 
        });
        return false;
    });
});
</script>
</html>
