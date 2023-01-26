<!DOCTYPE html>
<html>
<head>
    <link REL='SHORTCUT ICON' HREF='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/images/favicon.ico'>
            <link type='text/css' rel='stylesheet' href='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/static/bootstrap-3.3.4/css/bootstrap.css'/>
            <link type='text/css' rel='stylesheet' href='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/stylesheets/grinder.css'/>
            <link type='text/css' rel='stylesheet' href='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/stylesheets/grinderindex.css'/>
    
    <title>b33-34-vm1.lab.archivas.com</title>
</head>
<body style="background-color:  #768dad">
<nav class="navbar navbar-default navbar-inverse navbar-fixed-top" id='grindernav' style="box-shadow: 0 0 7px #000000;">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="http://b33-34-vm1.lab.archivas.com">b33-34-vm1.lab.archivas.com</a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Quick Links <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href='http://odin/clusters/myclusters/'>Clusters</a></li>
                    <li><a href='http://odin/queues/'>Queues</a></li>
                    <li><a href='http://pxe.archivas.com/scoreboard/scoreboard.php'>Scoreboard</a></li>
                </ul>
            </li>
            <li><a href="http://grinder/scoreboard/history.php?client=b33-34-vm1.lab.archivas.com">History</a></li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Tools <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href='http://odin/'>Odin</a></li>
                    <li><a href='http://pxe.archivas.com/nexus/thresher.py'>Queues</a></li>
                    <li><a href='http://pxe.archivas.com/scoreboard/scoreboard.php'>Scoreboard</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div id="main_container" class="container.fluid">
    
<ol class="breadcrumb">
    <li><a href='http://b33-34-vm1.lab.archivas.com/grinder/index.php'>Index</a></li> &raquo; <li><a href='http://b33-34-vm1.lab.archivas.com/grinder/index.php?path=./upgrade_compare_db.py-2018-02-12-15.13.06'>upgrade_compare_db.py-2018-02-12-15.13.06</a></li> &raquo; <li><a href='http://b33-34-vm1.lab.archivas.com/grinder/index.php?path=./upgrade_compare_db.py-2018-02-12-15.13.06/collateral'>collateral</a></li> &raquo; <li><a href='http://b33-34-vm1.lab.archivas.com/grinder/index.php?path=./upgrade_compare_db.py-2018-02-12-15.13.06/collateral/UpgradeCompareFrom110'>UpgradeCompareFrom110</a></li> &raquo; <li>upgraded_functions.log</li></ol>

<!-- Results and CMDLine View -->
    <div class="panel panel-default">
                        <div class="panel-body">
                <dl class="infoList">
                        <dt>Log Level</dt>
                <dd>
                    <select id='filter' onChange="top.location.href='http://b33-34-vm1.lab.archivas.com/grinder/index.php?path=./upgrade_compare_db.py-2018-02-12-15.13.06/collateral/UpgradeCompareFrom110/upgraded_functions.log&filter=' + this.value;">
                        <option value="WARNING" >WARNING</option>
<option value="TEST" >TEST</option>
<option value="INFO" SELECTED>INFO</option>
<option value="FINE" >FINE</option>
<option value="FINER" >FINER</option>
                    </select>
                </dd>
                </dl>
        </div>
    </div>

<!-- MAIN FileView -->
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">upgraded_functions.log</h3>
    </div>
    <div class="panel-body textScroll">
        <span class="pre">
=========== NEXT VALUE ===========

Name: fs_id_int
Schema: fs_120
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 120::BIGINT;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: accessible_historic_mountpoints_lookup_after
Schema: fs_func_v120
Result Data Type: SETOF resolved_historic_mountpoint
Argument Data Types: fullpath character varying, after_timestamp timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT f.fs_id, t2.mp_path, t2.mp_parent, t2.mp_name,
           (f.owner_id IS NOT NULL AND f.owner_id = userid),
           f.shared_time, (t2.v).sync, f.type,
           (t2.v).timestamp, (t2.v).tsextra, (t2.v).replaced, (t2.v).event
        FROM filesystem f,
             (SELECT ppm.mountpoint_path mp_path, ppm.parent mp_parent, ppm.name mp_name,
                     historic_mountpoint_versions_lookup_after(ppm.mountpoint_path, $2) v
                  FROM possible_parent_mountpoints($1) ppm) t2,
             user_extract_id(fs_id()) userid
        WHERE f.fs_id = (t2.v).fs_id
          AND NOT fs_is_mobilized(f.type)
          AND ((t2.v).replaced IS NULL OR sf_is_accessible_at_past_time(f, userid))
        ORDER BY (t2.v).timestamp, (t2.v).tsextra;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: accessible_historic_mountpoints_lookup_before
Schema: fs_func_v120
Result Data Type: SETOF resolved_historic_mountpoint
Argument Data Types: fullpath character varying, before_timestamp timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT f.fs_id, t2.mp_path, t2.mp_parent, t2.mp_name,
           (f.owner_id IS NOT NULL AND f.owner_id = userid),
           f.shared_time, (t2.v).sync, f.type,
           (t2.v).timestamp, (t2.v).tsextra, (t2.v).replaced, (t2.v).event
        FROM filesystem f,
             (SELECT ppm.mountpoint_path mp_path, ppm.parent mp_parent, ppm.name mp_name,
                     historic_mountpoint_versions_lookup_before(ppm.mountpoint_path, $2) v
                  FROM possible_parent_mountpoints($1) ppm) t2,
             user_extract_id(fs_id()) userid
        WHERE f.fs_id = (t2.v).fs_id
          AND NOT fs_is_mobilized(f.type)
          AND ((t2.v).replaced IS NULL OR sf_is_accessible_at_past_time(f, userid))
        ORDER BY ((t2.v).timestamp, (t2.v).tsextra) DESC;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_archive_list
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: before_timestamp timestamp with time zone, after_version_id bigint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rec RECORD;
    last_version_id BIGINT := 0;
    result dir_entry_result;
BEGIN
    FOR rec IN EXECUTE $q$
        WITH versions AS (
            SELECT * from version
            WHERE replaced IS NOT NULL AND replaced &lt; $1 AND pruned = TRUE AND version_id &gt; $2
            ORDER BY version_id LIMIT $3
        )
        SELECT p.full_path, d.*, v.*, r.TIMESTAMP AS read_timestamp, r.tsextra AS read_tsextra, 
                r.event AS read_event, r.client_id AS read_client_id, r.args AS read_args
            FROM dir_entry p, dir_entry d, versions v
                LEFT JOIN version_read r ON v.version_id = r.version_id
            WHERE d.entry_id = v.entry_id AND p.entry_id = d.parent_entry_id
            ORDER BY v.version_id, r.timestamp, r.tsextra
        $q$ USING before_timestamp, after_version_id, MAX
    LOOP
        IF rec.version_id &lt;&gt; last_version_id THEN
            result := (rec.full_path, rec.name, rec.version_id, rec.content_id, rec.entry_type,
                       rec.mtime, rec.size, rec.hash, NULL::BIGINT, NULL::VARCHAR, rec.conflict, rec.entry_id,
                       rec.is_create, rec.pruned, rec.event, rec.timestamp, rec.tsextra,
                       rec.client_id, rec.fs_id, rec.args, rec.is_collapsed,
                       rec.move_target_version, rec.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, rec.replaced,
                       dir_entry_full_perms())::dir_entry_result;
            RETURN NEXT result;
        END IF;
        IF rec.read_event IS NOT NULL THEN
            result := (rec.full_path, rec.name, rec.version_id, rec.content_id, rec.entry_type,
                       rec.mtime, rec.size, rec.hash, NULL::BIGINT, NULL::VARCHAR, rec.conflict, rec.entry_id,
                       rec.is_create, rec.pruned, rec.read_event, rec.read_timestamp, rec.read_tsextra,
                       rec.read_client_id, rec.fs_id, rec.read_args, rec.is_collapsed,
                       rec.move_target_version, rec.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, rec.replaced,
                       dir_entry_full_perms())::dir_entry_result;
            RETURN NEXT result;
        END IF;
        last_version_id = rec.version_id;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_audit_modify_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, left_timestamp timestamp with time zone, pruned boolean, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, v.event,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN timestamp ELSE $5 END,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN tsextra ELSE 0::SMALLINT END,
           v.client_id, v.fs_id, v.args, v.is_collapsed, v.move_target_version, v.sync, 
           NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v
        WHERE d.entry_id = v.entry_id
            AND (timestamp, tsextra) &lt; ($3, $4)                   -- created before desired time
            AND ($5 IS NULL OR timestamp &gt;= $5)                   -- created after earliest timestamp
            AND ($6 IS NULL OR timestamp &lt; $6)                    -- existed before (created before) left filesystem
            AND ($7 OR NOT pruned)
            AND NOT version_hide
        ORDER BY timestamp DESC, tsextra DESC LIMIT $8;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: after_timestamp timestamp with time zone, after_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result((p.full_path, d.*, v.*)::dir_entry_full)
        FROM dir_entry p, dir_entry d, version v
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND NOT activity_hide
            AND (timestamp, tsextra) &gt; ($1, $2)                      -- created after desired time
            AND ($3 IS NULL OR timestamp &gt;= $3)                      -- created after earliest_timestamp
            AND ($4 IS NULL OR timestamp &lt; $4)                       -- created before latest_timestamp
        ORDER BY timestamp, tsextra LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, pruned boolean, include_hidden boolean, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, v.event,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN timestamp ELSE $5 END,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN tsextra ELSE 0::SMALLINT END,
           v.client_id, v.fs_id, v.args, v.is_collapsed, v.move_target_version, v.sync, 
           NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v
        WHERE d.entry_id = v.entry_id
            AND CASE WHEN $5 IS NULL OR $5 &lt;= $3 THEN
                    -- if joined fs before desired time, must be created after desired time
                    (timestamp, tsextra) &gt; ($3, $4)
                ELSE
                    -- else joined after desired time; must have existed after joining (could have been created before joining)
                    (replaced IS NULL OR replaced &gt; $5)
                END
            AND ($6 IS NULL OR timestamp &lt; $6)  -- existed before left filesystem
            AND ($7 OR NOT pruned)
            AND ($8 OR NOT version_hide)
        ORDER BY timestamp, tsextra LIMIT $9;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result((p.full_path, d.*, v.*)::dir_entry_full)
        FROM dir_entry p, dir_entry d, version v
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND NOT activity_hide
            AND (timestamp, tsextra) &lt; ($1, $2)                     -- created before desired time
            AND ($3 IS NULL OR timestamp &gt;= $3)                     -- created after earliest_timestamp
            AND ($4 IS NULL OR timestamp &lt; $4)                      -- created before latest_timestamp
        ORDER BY timestamp DESC, tsextra DESC LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, pruned boolean, include_hidden boolean, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, v.event,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN timestamp ELSE $5 END,
           CASE WHEN $5 IS NULL OR timestamp &gt;= $5 THEN tsextra ELSE 0::SMALLINT END,
           v.client_id, v.fs_id, v.args, v.is_collapsed, v.move_target_version, v.sync, 
           NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v
        WHERE d.entry_id = v.entry_id
            AND (timestamp, tsextra) &lt; ($3, $4)                   -- created before desired time
            AND ($5 IS NULL OR replaced IS NULL OR replaced &gt; $5) -- existed after (replaced after) joined filesystem
            AND ($6 IS NULL OR timestamp &lt; $6)                    -- existed before (created before) left filesystem
            AND ($7 OR NOT pruned)
            AND ($8 OR NOT version_hide)
        ORDER BY timestamp DESC, tsextra DESC LIMIT $9;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: after_timestamp timestamp with time zone, after_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT p.full_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM dir_entry p, dir_entry d, version v, version_read r
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND r.version_id = v.version_id
            AND (r.timestamp, r.tsextra) &gt; ($1, $2)                     -- read after desired time
            AND ($3 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $3)   -- version existed after (replaced after) earliest_timestamp
            AND ($4 IS NULL OR v.timestamp &lt; $4)                        -- version created before latest_timestamp
            AND r.event &lt;&gt; 'READ'::version_event
        ORDER BY r.timestamp, r.tsextra LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v, version_read r
        WHERE d.entry_id = v.entry_id
            AND v.version_id = r.version_id
            AND (r.timestamp, r.tsextra) &gt; ($3, $4)                   -- read after desired time
            AND ($5 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $5) -- version existed after (replaced after) joined filesystem
            AND ($5 IS NULL OR r.timestamp &gt; $5)                      -- read after joined filesystem
            AND ($6 IS NULL OR r.timestamp &lt; $6)                      -- read before left filesystem
            AND r.event &lt;&gt; 'READ'::version_event
        ORDER BY r.timestamp, r.tsextra LIMIT $7;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT p.full_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM dir_entry p, dir_entry d, version v, version_read r
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND r.version_id = v.version_id
            AND (r.timestamp, r.tsextra) &lt; ($1, $2)                    -- read before desired time
            AND ($3 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $3)  -- version existed after (replaced after) earliest_timestamp
            AND ($4 IS NULL OR v.timestamp &lt; $4)                       -- version created before latest_timestamp
            AND r.event &lt;&gt; 'READ'::version_event
        ORDER BY r.timestamp DESC, r.tsextra DESC LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v, version_read r
        WHERE d.entry_id = v.entry_id
            AND v.version_id = r.version_id
            AND (r.timestamp, r.tsextra) &lt; ($3, $4)                   -- read before desired time
            AND ($5 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $5) -- version existed after (replaced after) joined filesystem
            AND ($5 IS NULL OR r.timestamp &gt; $5)                      -- read after joined filesystem
            AND ($6 IS NULL OR r.timestamp &lt; $6)                      -- read before left filesystem
            AND ($7 IS NULL OR r.timestamp &gt;= $7)                     -- read after earliest_timestamp
            AND r.event &lt;&gt; 'READ'::version_event
        ORDER BY r.timestamp DESC, r.tsextra DESC LIMIT $8;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: after_timestamp timestamp with time zone, after_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT p.full_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM dir_entry p, dir_entry d, version v, version_read r
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND r.version_id = v.version_id
            AND (r.timestamp, r.tsextra) &gt; ($1, $2)                     -- read after desired time
            AND ($3 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $3)   -- version existed after (replaced after) earliest_timestamp
            AND ($4 IS NULL OR v.timestamp &lt; $4)                        -- version created before latest_timestamp
            AND r.event = 'READ'::version_event
        ORDER BY r.timestamp, r.tsextra LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_after
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v, version_read r
        WHERE d.entry_id = v.entry_id
            AND v.version_id = r.version_id
            AND (r.timestamp, r.tsextra) &gt; ($3, $4)                   -- read after desired time
            AND ($5 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $5) -- version existed after (replaced after) joined filesystem
            AND ($5 IS NULL OR r.timestamp &gt; $5)                      -- read after joined filesystem
            AND ($6 IS NULL OR r.timestamp &lt; $6)                      -- read before left filesystem
            AND r.event = 'READ'::version_event
        ORDER BY r.timestamp, r.tsextra LIMIT $7;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, latest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT p.full_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, v.sync, 
           NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM dir_entry p, dir_entry d, version v, version_read r
        WHERE p.entry_id = d.parent_entry_id
            AND d.entry_id = v.entry_id
            AND r.version_id = v.version_id
            AND (r.timestamp, r.tsextra) &lt; ($1, $2)                    -- read before desired time
            AND ($3 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $3)  -- version existed after (replaced after) earliest_timestamp
            AND ($4 IS NULL OR v.timestamp &lt; $4)                       -- version created before latest_timestamp
            AND r.event = 'READ'::version_event
        ORDER BY r.timestamp DESC, r.tsextra DESC LIMIT $5;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, before timestamp with time zone, before_tsextra smallint, joined_timestamp timestamp with time zone, left_timestamp timestamp with time zone, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT d.parent_path, d.name, v.version_id, v.content_id, d.entry_type,
           v.mtime, v.size, v.hash, NULL::BIGINT, NULL::VARCHAR, v.conflict,
           d.entry_id, v.is_create, v.pruned, r.event, r.timestamp, r.tsextra,
           r.client_id, v.fs_id, r.args, v.is_collapsed, v.move_target_version, 
           v.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, v.replaced, dir_entry_full_perms()
        FROM file_entry_lookup($1, $2) d, version v, version_read r
        WHERE d.entry_id = v.entry_id
            AND v.version_id = r.version_id
            AND (r.timestamp, r.tsextra) &lt; ($3, $4)                   -- read before desired time
            AND ($5 IS NULL OR v.replaced IS NULL OR v.replaced &gt; $5) -- version existed after (replaced after) joined filesystem
            AND ($5 IS NULL OR r.timestamp &gt; $5)                      -- read after joined filesystem
            AND ($6 IS NULL OR r.timestamp &lt; $6)                      -- read before left filesystem
            AND ($7 IS NULL OR r.timestamp &gt;= $7)                     -- read after earliest_timestamp
            AND r.event = 'READ'::version_event
        ORDER BY r.timestamp DESC, r.tsextra DESC LIMIT $8;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: apply_directory_entry_filter
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: filter directory_entry_filter, fs_id bigint, sync boolean
Volatility: immutable
Language: sql
Source Code:

    SELECT ($1 = 'ALL_ENTRIES'::directory_entry_filter)
        OR ($1 = 'SYNCING_ONLY'::directory_entry_filter AND $3)
        OR ($1 = 'AW_ONLY'::directory_entry_filter AND ($2 IS NULL OR (NOT fs_is_mobilized($2) AND ($3 OR (NOT $3 AND NOT (fs_is_edp($2)))))))
        OR ($1 = 'LINK'::directory_entry_filter AND ($2 is NULL OR (NOT fs_is_mobilized($2))));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: archive_delete_before
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: before_timestamp timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    version_rec version;
BEGIN
    FOR version_rec IN EXECUTE $q$ SELECT * FROM version_replaced_delete_before($1) $q$ 
        USING before_timestamp LOOP
        EXECUTE $q$ SELECT * FROM version_read_delete_version($1) $q$
            USING version_rec.version_id;
        IF version_rec.latest THEN
            EXECUTE $q$ DELETE FROM dir_entry WHERE entry_id = $1 $q$ USING version_rec.entry_id;
        END IF;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: archive_empty_filesystem
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rowcount BIGINT;
BEGIN
    IF fs_is_inactive($1) THEN
        EXECUTE $q$ SELECT COUNT(v.version_id) FROM (SELECT version_id FROM version LIMIT 2) v $q$ INTO rowcount;
        IF rowcount &lt;= 1 THEN
            PERFORM filesystem_delete($1);
            PERFORM drop_filesystem($1);
        END IF;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_prune_indexes
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: prune_age_secs integer, max_versions integer, fs_age_prune boolean, fs_max_version_prune integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    needs_update BOOLEAN := FALSE;
    oldindexdef VARCHAR;
BEGIN
    -- detect if we're using an out of date index def (from pre-Boole) and update it
    IF prune_age_secs IS NOT NULL AND (fs_age_prune = TRUE) THEN
        oldindexdef := pg_get_indexdef(indexrelid) FROM pg_stat_user_indexes 
            WHERE schemaname = fsid_to_schema(fs_id()) AND indexrelname = 'idx_version_replaced';
        IF strpos(oldindexdef, 'pruned') &gt; 0 THEN
            EXECUTE $q$DROP INDEX IF EXISTS idx_version_replaced$q$;
            fs_age_prune = FALSE;
        END IF;
    END IF;

    IF prune_age_secs IS NOT NULL AND (fs_age_prune IS NULL OR fs_age_prune = FALSE) THEN
        EXECUTE $q$ CREATE INDEX idx_version_replaced ON version(replaced)
                WHERE replaced IS NOT NULL $q$;
        fs_age_prune := TRUE;
        needs_update := TRUE;
    ELSIF prune_age_secs IS NULL AND fs_age_prune = TRUE THEN
        EXECUTE $q$DROP INDEX IF EXISTS idx_version_replaced$q$;
        fs_age_prune := NULL;
        needs_update := TRUE;
    END IF;

    IF max_versions IS NULL AND fs_max_version_prune IS NOT NULL THEN
        EXECUTE $q$DROP INDEX IF EXISTS idx_dir_entry_version_count$q$;
        needs_update := TRUE;
    ELSIF max_versions IS NOT NULL AND fs_max_version_prune IS NULL THEN
        EXECUTE $q$CREATE INDEX idx_dir_entry_version_count ON dir_entry(entry_id)
                WHERE version_count &gt; $q$ || max_versions;
        needs_update := TRUE;
    ELSIF max_versions &lt;&gt; fs_max_version_prune THEN
        EXECUTE $q$DROP INDEX IF EXISTS idx_dir_entry_version_count$q$;
        EXECUTE $q$CREATE INDEX idx_dir_entry_version_count ON dir_entry(entry_id)
                WHERE version_count &gt; $q$ || max_versions;
        needs_update := TRUE;
    ELSIF max_versions IS NOT NULL THEN
        -- If there's no update necessary, just make sure the index exists before continuing.
        EXECUTE $q$CREATE INDEX IF NOT EXISTS idx_dir_entry_version_count ON dir_entry(entry_id)
                WHERE version_count &gt; $q$ || max_versions;
    END IF;

    IF needs_update THEN
        PERFORM filesystem_update_prune_values(fs_id(), fs_age_prune, max_versions);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: convert_entry_type
Schema: fs_func_v120
Result Data Type: integer
Argument Data Types: in_entry_type entry_type
Volatility: immutable
Language: sql
Source Code:

    SELECT CASE WHEN 'DIRECTORY'::entry_type = $1 THEN 1 WHEN 'FILE'::entry_type = $1 THEN 2
        ELSE 0 END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_common_move_functions
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: src_fsid bigint, dest_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN

    EXECUTE $SSS$
        -- Update or insert a new dir_entry for name with a parent of parent_entry
        CREATE OR REPLACE FUNCTION dest_dir_entry_upsert_fast(in_parent_entry_id BIGINT, in_parent_path VARCHAR,
                                       in_name VARCHAR, in_entry_type entry_type, thelimits limits,
                                       OUT de dir_entry, OUT de_created BOOLEAN)
        AS $$
        DECLARE
            full_path VARCHAR;
            full_path_entry VARCHAR;
            version_count INTEGER;
        BEGIN
            full_path := full_path(in_parent_path, in_name);
            IF thelimits IS NOT NULL THEN
                PERFORM limit_path_length(full_path, thelimits);
                PERFORM limit_entry_name(in_name, thelimits);
            END IF;
            IF in_entry_type = 'DIRECTORY' THEN
                full_path_entry := full_path;
            ELSE
                version_count := 0;
            END IF;
            de_created := FALSE;
            UPDATE $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.dir_entry SET name = in_name, full_path = full_path_entry
                    WHERE parent_entry_id = in_parent_entry_id AND hash(normalize(name)) = hash(normalize(in_name))
                        AND normalize(name) = normalize(in_name) AND entry_type = in_entry_type RETURNING *
                INTO de;
            IF de.entry_id IS NULL THEN
                de_created := TRUE;
                INSERT INTO $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.dir_entry(
                        entry_id, parent_entry_id, name, entry_type, full_path, version_count)
                    VALUES (dest_entry_id_next(), in_parent_entry_id, in_name, in_entry_type,
                            full_path_entry, version_count) RETURNING *
                    INTO de;
            END IF;
        END
        $$ LANGUAGE PLPGSQL;

        -- Insert a new latest entry into the version table
        -- todo: rip out unused_replaced arg; it is no longer used
        CREATE OR REPLACE FUNCTION dest_insert_latest_version_fast(in_entry_id BIGINT,
                                                                   is_create BOOLEAN,
                                                                   pruned BOOLEAN,
                                                                   conflict BOOLEAN,
                                                                   activity_hide BOOLEAN,
                                                                   event version_event,
                                                                   mtime TIMESTAMPTZ,
                                                                   client_id BIGINT,
                                                                   size BIGINT,
                                                                   hash BYTEA,
                                                                   children INTEGER,
                                                                   fs_id BIGINT,
                                                                   args VARCHAR,
                                                                   unused_replaced TIMESTAMPTZ,
                                                                   is_collapsed BOOLEAN,
                                                                   move_target_version BIGINT,
                                                                   contentid BIGINT,
                                                                   is_new_entry BOOLEAN,
                                                                   sync BOOLEAN,
                                                                   version_hide BOOLEAN,
                                                                   delete_hide BOOLEAN)
        RETURNS version AS $$
        DECLARE
            result version;
        BEGIN
            IF is_new_entry = FALSE THEN
                UPDATE $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.version SET latest = FALSE,
                    replaced = statement_timestamp()
                    WHERE entry_id = $1 AND latest = TRUE;
            END IF;
            IF is_collapsed = FALSE THEN
                UPDATE $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.version SET is_collapsed = TRUE
                    WHERE entry_id = $1 AND is_collapsed = FALSE AND move_target_version IS NULL;
            END IF;
           -- the daily/weekly/monthly flag is only set on a version (and cleared on previous versions)
           -- if it is a CREATE and it is NOT a hidden version
            UPDATE $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.version
                SET is_daily = CASE WHEN timestamp &gt;= start_of_interval('days') THEN FALSE ELSE is_daily END,
                    is_weekly = CASE WHEN timestamp &gt;= start_of_interval('weeks') THEN FALSE ELSE is_weekly END,
                    is_monthly = FALSE
                WHERE $2 AND NOT $20 AND entry_id = $1 AND timestamp &gt;= start_of_interval('months')
                    AND (is_daily = TRUE OR is_weekly = TRUE OR is_monthly = TRUE);

            INSERT INTO $SSS$ || fsid_to_schema(dest_fsid) || $SSS$.version
                (version_id, entry_id, latest, is_create, pruned, conflict,
                    activity_hide, event, mtime, timestamp, tsextra, client_id, size,
                    hash, children, fs_id, args, replaced, is_collapsed, move_target_version, content_id, sync,
                    is_daily, is_weekly, is_monthly, version_hide, delete_hide)
                VALUES (dest_version_id_next(), $1, TRUE, $2, $3, $4, $5, $6, $7, statement_timestamp(),
                        tsextra_next(), $8, $9, $10, $11, $12, $13,
                        NULL::TIMESTAMPTZ, $15, $16, $17, $19,
                        $2 AND NOT $20, $2 AND NOT $20, $2 AND NOT $20, $20, $21) RETURNING *
                INTO result;
            RETURN result;
        END
        $$ LANGUAGE PLPGSQL;

        -- Insert a new latest entry into the version table
        -- todo: rip out unused_replaced arg; it is no longer used
        CREATE OR REPLACE FUNCTION src_insert_latest_version_fast(in_entry_id BIGINT, in_is_create BOOLEAN,
                                           in_pruned BOOLEAN, in_conflict BOOLEAN,
                                           in_activity_hide BOOLEAN, in_event version_event,
                                           in_mtime TIMESTAMPTZ, in_client_id BIGINT, in_size BIGINT,
                                           in_hash BYTEA, in_children INTEGER, in_fs_id BIGINT,
                                           in_args VARCHAR, unused_replaced TIMESTAMPTZ,
                                           in_is_collapsed BOOLEAN, in_move_target_version BIGINT,
                                           in_contentid BIGINT, is_new_entry BOOLEAN, sync BOOLEAN,
                                           version_hide BOOLEAN)
        RETURNS version AS $$
        DECLARE
            result version;
        BEGIN
            IF is_new_entry = FALSE THEN
                UPDATE $SSS$ || fsid_to_schema(src_fsid) || $SSS$.version SET latest = FALSE,
                    replaced = statement_timestamp()
                    WHERE entry_id = $1 AND latest = TRUE;
            END IF;
            IF in_is_collapsed = FALSE THEN
                UPDATE $SSS$ || fsid_to_schema(src_fsid) || $SSS$.version SET is_collapsed = TRUE
                    WHERE entry_id = $1 AND is_collapsed = FALSE AND move_target_version IS NULL;
            END IF;
            INSERT INTO $SSS$ || fsid_to_schema(src_fsid) || $SSS$.version
                (version_id, entry_id, latest, is_create, pruned, conflict,
                    activity_hide, event, mtime, timestamp, tsextra, client_id, size,
                    hash, children, fs_id, args, replaced, is_collapsed, move_target_version, content_id, sync,
                    version_hide, delete_hide)
                VALUES (src_version_id_next(), $1, TRUE, $2, $3, $4, $5, $6, $7, statement_timestamp(),
                        tsextra_next(), $8, $9, $10, $11, $12, $13, NULL::TIMESTAMPTZ,
                         $15, $16, $17, $19, $20, CASE WHEN in_event = 'DELETE'::version_event THEN $5 ELSE FALSE END) RETURNING *
                INTO result;
            RETURN result;
        END
        $$ LANGUAGE PLPGSQL;

        CREATE OR REPLACE FUNCTION dest_version_id_next() RETURNS BIGINT AS $$
        DECLARE
            result BIGINT;
        BEGIN
            SELECT nextval('$SSS$ || fsid_to_schema(dest_fsid) || $SSS$.version_id_seq') INTO result;
            RETURN result;
        END;
        $$ LANGUAGE PLPGSQL;

        CREATE OR REPLACE FUNCTION dest_entry_id_next() RETURNS BIGINT AS $$
        DECLARE
            result BIGINT;
        BEGIN
            SELECT nextval('$SSS$ || fsid_to_schema(dest_fsid) || $SSS$.entry_id_seq') INTO result;
            RETURN result;
        END;
        $$ LANGUAGE PLPGSQL;

        CREATE OR REPLACE FUNCTION src_version_id_next() RETURNS BIGINT AS $$
        DECLARE
            result BIGINT;
        BEGIN
            SELECT nextval('$SSS$ || fsid_to_schema(src_fsid) || $SSS$.version_id_seq') INTO result;
            RETURN result;
        END;
        $$ LANGUAGE PLPGSQL;

        CREATE OR REPLACE FUNCTION src_entry_id_next() RETURNS BIGINT AS $$
        DECLARE
            result BIGINT;
        BEGIN
            SELECT nextval('$SSS$ || fsid_to_schema(src_fsid) || $SSS$.entry_id_seq') INTO result;
            RETURN result;
        END;
        $$ LANGUAGE PLPGSQL;

    $SSS$;

END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_conflict_name
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: parent dir_lookup_result, name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    i INTEGER := 0;
    conflict_name VARCHAR;
    current_entry dir_entry_full;
BEGIN
    LOOP
        SELECT SUBSTRING(r[1], 0, (limits()).entry_name - length(gcs) - length(r[2])) || gcs || r[2]
            FROM gen_conflict_string(user_extract_id(client_id), i) AS gcs,
                regexp_matches(name, '(.*?)(()|(\.[^\.]*))$') AS r -- splits the name into file name extension
            INTO conflict_name;
        EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$ USING parent, conflict_name
            INTO current_entry;
        IF current_entry.version_id IS NULL THEN
            RETURN conflict_name;
        END IF;
        i := i + 1;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_filesystem_fs
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: filesystem_id bigint, owner_id bigint, type filesystem_type, label character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_clientId BIGINT;
BEGIN
    IF type &lt;&gt; 'TEAM'::filesystem_type AND owner_id IS NULL THEN
        RAISE EXCEPTION 'owner_id can not be null';
    END IF;
    IF type != 'PRIVATE'::filesystem_type AND (label IS NULL OR char_length(label) &lt; 1) THEN
        RAISE EXCEPTION 'label must not be null or empty';
    END IF;
    IF type = 'EDP'::filesystem_type THEN
        fs_clientId := client_id;
    END IF;
    IF create_filesystem_int(filesystem_id, owner_id, type, label, fs_version_latest(), fs_clientId) THEN
        EXECUTE $$INSERT INTO dir_entry (entry_id, parent_entry_id, name, entry_type, full_path)
                VALUES (1, -1, '', 'DIRECTORY'::entry_type, '/')$$;
        EXECUTE $$ INSERT INTO version (version_id, entry_id, latest, is_create, pruned, conflict,
                    activity_hide, event, mtime, timestamp, tsextra, client_id, children,
                    content_id, version_hide)
                VALUES (0, 1, TRUE, TRUE, FALSE, FALSE, TRUE, 'CREATE'::version_event, now(),
                    now(), tsextra_next(), $1, 0, content_id_next(), FALSE) $$ USING client_id;
    END IF;
    RETURN 0;  -- returns the version_id inserted
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_filesystem_int
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: filesystem_id bigint, owner_id bigint, fstype filesystem_type, label character varying, version integer, client_id bigint DEFAULT NULL::bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    filesystem_schema VARCHAR;
    joined_cnt BIGINT := 0;
BEGIN
    filesystem_schema := fsid_to_schema(filesystem_id);

    IF NOT EXISTS(SELECT schema_name FROM information_schema.schemata
            WHERE schema_name = filesystem_schema) THEN
        EXECUTE 'CREATE SCHEMA '|| filesystem_schema;
        
        PERFORM set_path_to_fs(filesystem_id, version, fstype::VARCHAR);
        -- this must be executed to use the search path.
        PERFORM create_filesystem_tables(filesystem_id);
    
        IF fstype = 'TEAM'::filesystem_type OR owner_id IS NOT NULL THEN
            IF fstype = 'SHARED'::filesystem_type OR fstype = 'TEAM'::filesystem_type THEN
                joined_cnt := 1;
            END IF;
            INSERT INTO filesystem(fs_id, owner_id, xid, sum_file_size, file_count, dir_count,
                    conflict_count, version, type, shared_time, label, joined_count, client_id, cray_time)
                VALUES (filesystem_id, owner_id, 0, 0, 0, 0, 0, version, fstype, now(), label,
                        joined_cnt, client_id, now());
        END IF;
        RETURN TRUE;
    ELSE
        PERFORM set_path_to_fs(filesystem_id, version, fstype::VARCHAR);
        RETURN FALSE;
    END IF;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_filesystem_tables
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CREATE SEQUENCE version_id_seq;
    CREATE SEQUENCE entry_id_seq MINVALUE 2;

    CREATE TABLE dir_entry(
        entry_id BIGINT NOT NULL,
        parent_entry_id BIGINT NOT NULL,
        name VARCHAR NOT NULL,
        entry_type entry_type NOT NULL,
        full_path VARCHAR,
        version_count INTEGER,
        PRIMARY KEY (entry_id)
    );
    CREATE INDEX idx_dir_entry_name ON dir_entry(parent_entry_id, hash(normalize(name)));
    CREATE INDEX idx_dir_entry_path ON dir_entry(hash(normalize(full_path)))
        WHERE entry_type = 'DIRECTORY'::entry_type;

    CREATE TABLE version(
        version_id bigint NOT NULL,
        entry_id BIGINT NOT NULL,
        latest BOOLEAN NOT NULL,
        is_create BOOLEAN NOT NULL,
        pruned BOOLEAN NOT NULL,
        conflict BOOLEAN NOT NULL,
        activity_hide BOOLEAN NOT NULL,
        event version_event NOT NULL,
        mtime TIMESTAMPTZ NOT NULL,
        timestamp TIMESTAMPTZ NOT NULL,
        tsextra SMALLINT NOT NULL,
        client_id BIGINT NOT NULL,
        content_id BIGINT NOT NULL,
        size BIGINT,
        hash BYTEA,
        children INTEGER,
        fs_id BIGINT,
        replaced TIMESTAMPTZ,
        args VARCHAR,
        is_collapsed BOOLEAN NOT NULL DEFAULT TRUE,
        move_target_version BIGINT,
        sync BOOLEAN NOT NULL DEFAULT TRUE,
        is_daily            BOOLEAN       NOT NULL DEFAULT FALSE,
        is_weekly           BOOLEAN       NOT NULL DEFAULT FALSE,
        is_monthly          BOOLEAN       NOT NULL DEFAULT FALSE,
        version_hide BOOLEAN NOT NULL,
        delete_hide BOOLEAN NOT NULL DEFAULT FALSE
    );
    CREATE INDEX idx_version_version_id ON version(version_id);
    CREATE INDEX idx_version_history ON version(entry_id);
    CREATE INDEX idx_version_entry_latest ON version(entry_id) WHERE latest = TRUE;
    CREATE INDEX idx_version_entry_timestamp ON version(entry_id, timestamp)
        WHERE is_daily = TRUE OR is_weekly = TRUE OR is_monthly = TRUE;
    CREATE INDEX idx_version_version_latest ON version(version_id)
        WHERE (latest = TRUE OR is_collapsed = FALSE) AND (is_create OR NOT version_hide);
    CREATE INDEX idx_version_conflict ON version(entry_id) WHERE conflict = TRUE AND latest = TRUE;
    CREATE INDEX idx_version_timestamp ON version(timestamp, tsextra) WHERE activity_hide = FALSE;
    CREATE INDEX idx_version_fsid ON version(fs_id)
        WHERE fs_id IS NOT NULL AND is_create = TRUE;
    CREATE INDEX idx_version_collapsed on version(entry_id)
        WHERE is_collapsed = FALSE AND move_target_version IS NULL;
    -- Indexes created by prune service
    -- CREATE INDEX idx_version_replaced ON version(replaced) WHERE replaced IS NOT NULL
    -- CREATE INDEX idx_dir_entry_version_count ON dir_entry(entry_id) WHERE version_count

    CREATE TABLE version_read(
        timestamp TIMESTAMPTZ NOT NULL,
        tsextra SMALLINT NOT NULL,
        version_id BIGINT NOT NULL,
        event version_event NOT NULL,
        client_id BIGINT,
        args VARCHAR
    );
    CREATE INDEX idx_version_read_client ON version_read(timestamp, tsextra) WHERE event = 'READ'::version_event;
    CREATE INDEX idx_version_read_link ON version_read(timestamp, tsextra) WHERE event &lt;&gt; 'READ'::version_event;
    CREATE INDEX idx_version_read_id_client ON version_read(version_id) WHERE event = 'READ'::version_event;
    CREATE INDEX idx_version_read_id_link ON version_read(version_id) WHERE event &lt;&gt; 'READ'::version_event;

    -- This creates a function which returns the filesystem's ID
    -- This is done by creating a String which represents the function and 
    -- then executing it
    EXECUTE $id_quote$
        CREATE OR REPLACE FUNCTION fs_id_int() RETURNS BIGINT AS $$
            SELECT $id_quote$ || fs_id || $id_quote$::BIGINT;
        $$ LANGUAGE sql IMMUTABLE;
    $id_quote$;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_rename_functions
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CREATE OR REPLACE FUNCTION directory_entry_rename_fast_int(src_dir VARCHAR, src_name VARCHAR,
                                                               contentid BIGINT, dest_fsid BIGINT,
                                                               dest_dir VARCHAR, dest_name VARCHAR,
                                                               client_id BIGINT, make_dirs BOOLEAN,
                                                               create_conflict BOOLEAN, is_move BOOLEAN,
                                                               event version_event,
                                                               read_event version_event, read_args VARCHAR,
                                                               copy_deletes BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ,
                                                               version_hide BOOLEAN,
                                                               OUT move_result dir_entry_result,
                                                               OUT dest_mountpoints mount_point_result ARRAY)
    AS $$
    DECLARE
        src_dir_entry dir_lookup_result;
        src_entry dir_entry_full;
        src_fsid BIGINT;
        dest_dir_entry directory_lookup_result;
        dest_entry dir_entry_result;
        result RECORD;
        dest_conflict_cnt INTEGER := 0;
        conflict BOOLEAN := FALSE;
        cross_fs BOOLEAN := FALSE;
        stats cross_fs_file_stats;
        thelimits limits;
    BEGIN

        stats := (0, 0, 0, 0, 0, 0, 0, 0, 0, 0)::cross_fs_file_stats;
        dest_mountpoints := '{}';

        --search path is source
        SELECT * FROM directory_lookup_int(src_dir, copy_deletes, copy_deletes) INTO src_dir_entry;
        SELECT * FROM entry_lookup(src_dir_entry, src_name, NULL, copy_deletes) INTO src_entry;

        IF src_entry.content_id IS NULL THEN
            RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(src_dir, src_name);
        END IF;
        IF src_entry.content_id = contentid OR (is_move = FALSE AND contentid IS NULL) THEN
            src_fsid = fs_id();
            IF src_fsid &lt;&gt; dest_fsid THEN
                cross_fs := TRUE;
            END IF;

            SELECT * FROM dest_dir_and_entry_lookup(
                src_dir_entry.entry_id, src_entry.version_id, src_entry.entry_type, src_entry.is_create,
                dest_fsid, dest_dir, dest_name, client_id, make_dirs, create_conflict) INTO result;
            dest_dir_entry := result.dst_parent_result;
            dest_entry := result.dst_entry_result;
            stats.dest_conflict_count_delta := result.conflict_cnt;
            IF result.conflict_name IS NOT NULL THEN
                dest_name := result.conflict_name;
                conflict := TRUE;
            ELSIF cross_fs OR src_dir_entry.entry_id &lt;&gt; dest_dir_entry.entry_id THEN
                conflict := src_entry.conflict;  -- move (not rename); retain conflict info
            END IF;

            IF cross_fs = FALSE AND dest_entry.version_id = src_entry.version_id THEN
                move_result := dest_entry; -- rename/move to self; no-op
                RETURN;
            END IF;

            IF is_move AND (cross_fs OR src_dir_entry.entry_id &lt;&gt; dest_dir_entry.entry_id) THEN
                PERFORM directory_size_update(src_dir_entry.fs_id, src_dir_entry.version_ctid, -1);
            END IF;

            SELECT * FROM limits INTO thelimits;

            SELECT * FROM entry_rename_recursive(src_entry, src_fsid, dest_fsid, dest_dir_entry,
                                                 dest_name, conflict, version_hide, client_id, cross_fs,
                                                 is_move, event, read_event, read_args, thelimits, copy_deletes,
                                                 hide_deletes_earlier_than, version_hide, stats)
                INTO result;
            stats := result.stats;
            IF cross_fs THEN
                IF is_move THEN
                    PERFORM filesystem_update_stats(src_fsid, stats.src_file_count_delta,
                        stats.src_file_size_delta, stats.src_dir_count_delta,
                        stats.src_conflict_count_delta, stats.src_version_id);
                END IF;
                -- If we're unsharing a folder, no need to check limits;
                -- Files/folders already count towards owner's limits.
                IF event IS NULL OR event &lt;&gt; 'UNSHARE'::version_event THEN
                    PERFORM filesystem_update_stats(dest_fsid, stats.dest_file_count_delta,
                        stats.dest_file_size_delta, stats.dest_dir_count_delta,
                        stats.dest_conflict_count_delta, stats.dest_version_id);
                ELSE
                    PERFORM filesystem_update_stats(dest_fsid, stats.dest_file_count_delta,
                        stats.dest_file_size_delta, stats.dest_dir_count_delta,
                        stats.dest_conflict_count_delta, stats.dest_version_id, FALSE);
                END IF;
            ELSE
                PERFORM filesystem_update_stats(src_fsid,
                    stats.src_file_count_delta + stats.dest_file_count_delta,
                    stats.src_file_size_delta + stats.dest_file_size_delta,
                    stats.src_dir_count_delta + stats.dest_dir_count_delta,
                    stats.src_conflict_count_delta + stats.dest_conflict_count_delta,
                    greatest(stats.src_version_id, stats.dest_version_id));
            END IF;

            move_result := result.renamed;
            dest_mountpoints := result.dest_mountpoints;
        ELSE
            RAISE EXCEPTION 'ENTRY VERSION MISMATCH';
        END IF;
    END
    $$ LANGUAGE PLPGSQL;

    -- Insert a delete for a given entry
    -- Caller needs to make sure it is valid to insert a delete record at this location
    CREATE OR REPLACE FUNCTION src_entry_delete_fast(entry dir_entry_full,
                                                     hidden BOOLEAN,
                                                     client_id BIGINT,
                                                     in_is_collapsed BOOLEAN,
                                                     move_target_version BIGINT,
                                                     version_hide BOOLEAN)
    RETURNS version AS $$
    DECLARE
        result version;
    BEGIN
        UPDATE dir_entry SET version_count = version_count + 1 WHERE entry_id = ENTRY.entry_id
            AND entry_type = 'FILE'::entry_type;
        SELECT * FROM src_insert_latest_version_fast(entry.entry_id, FALSE, FALSE, FALSE, hidden,
                                                     'DELETE'::version_event, entry.mtime, client_id,
                                                     entry.size, ENTRY.hash, NULL::INTEGER,
                                                     entry.fs_id, NULL::VARCHAR, now(),
                                                     in_is_collapsed, move_target_version,
                                                     content_id_next(), FALSE, entry.sync,
                                                     version_hide)
        INTO result;
        RETURN result;
    END
    $$ LANGUAGE PLPGSQL;

    CREATE OR REPLACE FUNCTION entry_rename_recursive(src dir_entry_full, src_fsid BIGINT, dest_fsid BIGINT,
                                   dest_dir directory_lookup_result, dest_name VARCHAR, conflict BOOLEAN,
                                   hidden BOOLEAN, client_id BIGINT, cross_fs BOOLEAN, is_move BOOLEAN,
                                   event version_event,
                                   read_event version_event, read_args VARCHAR, thelimits limits,
                                   copy_deletes BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ, version_hide BOOLEAN,
                                   INOUT stats cross_fs_file_stats, OUT renamed dir_entry_result,
                                   OUT dest_mountpoints mount_point_result ARRAY)
    AS $$
    DECLARE
        dest dir_entry_result;
        sub_entry dir_entry_full;
        new_version version_type;
        sub_result RECORD;
        args VARCHAR;
        is_collapsed BOOLEAN := TRUE;
        move_target_version BIGINT := NULL;
    BEGIN
        dest_mountpoints := '{}';  -- empty array
        IF event IS NULL THEN
            IF is_move THEN
                IF hidden OR normalize(src.name) = normalize(dest_name) THEN
                    event := 'MOVE'::version_event;
                ELSE
                    event := 'RENAME'::version_event;
                    args := array_to_args(src.name);
                END IF;
            ELSE
                event := 'CREATE'::version_event;
            END IF;
        END IF;

        IF src.entry_type = 'DIRECTORY'::entry_type THEN
            -- upserts a dir_entry row and creates a version row in the target
            SELECT * FROM dest_dir_entry_copy_fast(src, src_fsid, dest_fsid, dest_dir, dest_name,
                conflict, hidden, event, client_id, args, NOT cross_fs AND is_move, thelimits,
                version_hide, hide_deletes_earlier_than) INTO renamed;
            stats.dest_version_id := renamed.version_id;
            IF src.is_create THEN
                stats.dest_dir_count_delta := stats.dest_dir_count_delta + 1;
            END IF;

            FOR sub_entry IN SELECT * FROM src_directory_list_fast(dir_entry_full_to_lookup(src),
                NULL::entry_type, copy_deletes, copy_deletes) LOOP

                SELECT * FROM entry_rename_recursive(sub_entry, src_fsid, dest_fsid,
                        (renamed.entry_id, full_path(renamed.parent, renamed.name))::directory_lookup_result,
                        sub_entry.name, is_move AND sub_entry.conflict, TRUE, client_id, cross_fs, 
                        is_move, event, read_event, read_args, thelimits, copy_deletes, 
                        hide_deletes_earlier_than, version_hide, stats)
                    INTO sub_result;
                stats := sub_result.stats;
                dest_mountpoints := array_cat(dest_mountpoints, sub_result.dest_mountpoints);
            END LOOP;
            IF src.fs_id IS NOT NULL THEN
                -- return the destination for the mountpoint
                dest_mountpoints := array_append(dest_mountpoints,
                    (src.fs_id, src.sync, full_path(renamed.parent, renamed.name))::mount_point_result);
                IF NOT cross_fs THEN
                    move_target_version := renamed.version_id;
                    is_collapsed := FALSE;
                END IF;
            END IF;
        END IF;
        -- insert delete version at the source (if it is not already deleted)
        IF is_move AND src.is_create THEN
            SELECT version_id
                FROM src_entry_delete_fast(src, TRUE, client_id, is_collapsed, move_target_version, version_hide)
                INTO stats.src_version_id;
            IF src.entry_type = 'DIRECTORY'::entry_type THEN
                stats.src_dir_count_delta := stats.src_dir_count_delta - 1;
            ELSE
                stats.src_file_count_delta := stats.src_file_count_delta - 1;
                stats.src_file_size_delta := stats.src_file_size_delta - src.size;
            END IF;
            IF src.conflict THEN
                stats.src_conflict_count_delta := stats.src_conflict_count_delta - 1;
            END IF;
        END IF;
        IF src.entry_type = 'FILE'::entry_type THEN
            -- upserts a dir_entry row and creates a version row in the target
            renamed := dest_dir_entry_copy_fast(src, src_fsid, dest_fsid, dest_dir, dest_name,
                conflict AND is_move, hidden, event, client_id, args, FALSE, thelimits, 
                version_hide, hide_deletes_earlier_than);
            stats.dest_version_id := renamed.version_id;
            IF src.is_create THEN
                stats.dest_file_count_delta := stats.dest_file_count_delta + 1;
                stats.dest_file_size_delta := stats.dest_file_size_delta +  renamed.size;
            END IF;
            IF conflict AND is_move THEN
                stats.dest_conflict_count_delta := stats.dest_conflict_count_delta + 1;
            END IF;

            IF read_event IS NOT NULL THEN
                -- Create a version read record at the source
                EXECUTE $q$
                    SELECT * FROM read_record($1, $2, $3, $4)
                $q$ USING src.version_id, client_id, read_event, read_args;
            END IF;
        END IF;
    END
    $$ LANGUAGE PLPGSQL;

    -- List entries in a directory
    CREATE OR REPLACE FUNCTION src_directory_list_fast(dir dir_lookup_result, in_entry_type entry_type,
        in_deleted BOOLEAN, in_pruned BOOLEAN)
    RETURNS SETOF dir_entry_full AS $$
    BEGIN
        RETURN QUERY SELECT dir.full_path, d.*, v.* FROM  dir_entry d, version v
            WHERE dir.entry_id = d.parent_entry_id AND d.entry_id = v.entry_id AND latest = TRUE
                AND (in_deleted OR is_create)  AND (in_pruned OR NOT pruned)
                AND (in_entry_type IS NULL OR entry_type = in_entry_type);
    END;
    $$ LANGUAGE PLPGSQL;

    -- Call dir_entry_copy on the specified func schema, affecting tables in the specified table_schema
    -- The passed in func_schema must be the schema on which this function is being executed.
    CREATE OR REPLACE FUNCTION dest_dir_entry_copy_fast(src dir_entry_full, src_fsid BIGINT,
                                                        dest_fsid BIGINT, dest_dir directory_lookup_result,
                                                        dest_name VARCHAR, conflict BOOLEAN, hidden BOOLEAN,
                                                        event version_event, client_id BIGINT,
                                                        args VARCHAR, copy_shareid BOOLEAN, thelimits limits,
                                                        version_hide BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ)
    RETURNS dir_entry_result
    AS $$
    DECLARE
        result dir_entry_result;
        shareid BIGINT;
    BEGIN
        IF copy_shareid THEN
            shareid = src.fs_id;
        END IF;
        SELECT * FROM dest_dir_entry_copy_fast(src, dest_dir, dest_name, conflict, hidden, event, client_id, args,
                shareid, thelimits, version_hide, hide_deletes_earlier_than) INTO result;
        RETURN result;
    END
    $$ LANGUAGE PLPGSQL;

    -- Copy an entry and update object count if needed
    CREATE OR REPLACE FUNCTION dest_version_copy_fast(src dir_entry_full, entry_id BIGINT,
            conflict BOOLEAN, hidden BOOLEAN, event version_event, client_id BIGINT, args VARCHAR,
            shareid BIGINT, content_id BIGINT, is_new_entry BOOLEAN, version_hide BOOLEAN,
            hide_deletes_earlier_than TIMESTAMPTZ)
    RETURNS version AS $$
    DECLARE
        result version;
        delete_hide BOOLEAN := FALSE;
    BEGIN
        IF src.entry_type = 'FILE'::entry_type AND src.is_create THEN
            PERFORM object_temp_ref_update(src.size, src.hash, 1);
        END IF;
        IF NOT src.is_create AND src.timestamp &lt; hide_deletes_earlier_than THEN
                delete_hide := TRUE;
        END IF;
        SELECT * FROM dest_insert_latest_version_fast($2, $1.is_create, $1.pruned, $3, $4, $5, $1.mtime, $6,
            $1.size, $1.hash, $1.children, $8, $7, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT,
            $9, $10, $1.sync, $11, delete_hide)
        INTO result;
        RETURN result;
    END
    $$ LANGUAGE PLPGSQL;

    CREATE OR REPLACE FUNCTION dest_version_copy_same_contentid_fast(src dir_entry_full,
                                                                     entry_id BIGINT,
                                                                     conflict BOOLEAN,
                                                                     hidden BOOLEAN,
                                                                     event version_event,
                                                                     client_id BIGINT,
                                                                     args VARCHAR,
                                                                     shareid BIGINT,
                                                                     is_new_entry BOOLEAN,
                                                                     version_hide BOOLEAN,
                                                                     hide_deletes_earlier_than TIMESTAMPTZ)
    RETURNS version AS $$
    DECLARE
        result version;
    BEGIN
        SELECT * FROM dest_version_copy_fast($1, $2, $3, $4, $5, $6, $7, $8, $1.content_id, is_new_entry, $10, $11)
            INTO result;
        RETURN result;
    END
    $$ LANGUAGE PLPGSQL;



    -- Copy a directory dir_entry from src to this filesystem under dest_dir with name dest_name.
    CREATE OR REPLACE FUNCTION dest_dir_entry_copy_fast(src dir_entry_full,
                                                        dest_dir directory_lookup_result,
                                                        dest_name VARCHAR, conflict BOOLEAN,
                                                        hidden BOOLEAN, event version_event,
                                                        client_id BIGINT, args VARCHAR,
                                                        shareid BIGINT, thelimits limits,
                                                        version_hide BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ)
    RETURNS dir_entry_result
    AS $$
    DECLARE
        result dir_entry_result;
        upsert_result RECORD;
        upsert_dir dir_entry;
        upsert_created BOOLEAN;
    BEGIN
        SELECT de, de_created FROM dest_dir_entry_upsert_fast(dest_dir.entry_id, dest_dir.full_path,
                                                              dest_name, src.entry_type, thelimits)
            INTO upsert_result;
        upsert_dir := upsert_result.de;
        upsert_created := upsert_result.de_created;
        result := dir_entry_full_to_result((dest_dir.full_path, upsert_dir.*, (dv.v).*)::dir_entry_full) FROM
            (SELECT upsert_dir, dest_version_copy_same_contentid_fast(src, upsert_dir.entry_id, conflict, hidden,
                                                                      event, client_id, args, shareid,
                                                                      upsert_created, version_hide,
                                                                      hide_deletes_earlier_than) v) dv;
        RETURN result;
    END
    $$ LANGUAGE PLPGSQL;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: decrement_ref_count
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: size bigint, hash bytea, is_create boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $3 THEN object_decrement_ref($1, $2) END;
    SELECT TRUE;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: decrement_version_count
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: entry_id bigint, pruned bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE dir_entry d SET version_count = version_count - $2 WHERE entry_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: delete_all
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: client_id bigint, fs_is_private boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT * from entry_delete_all($1);
    UPDATE version v
        SET pruned = decrement_ref_count(size, hash, is_create), size = NULL, hash = NULL,
            replaced = CASE WHEN replaced IS NULL THEN now() ELSE replaced END
        WHERE NOT pruned AND replaced IS NOT NULL
            AND ($2 = FALSE OR fs_id IS NULL OR
                 EXISTS (SELECT 1 FROM filesystem f WHERE f.fs_id = v.fs_id AND f.state = 'DELETED'::filesystem_state));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dest_dir_and_entry_lookup
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: src_dir_entryid bigint, src_versionid bigint, src_entry_type entry_type, src_is_create boolean, dst_fsid bigint, dst_dir character varying, dst_name character varying, client_id bigint, make_dirs boolean, create_conflict boolean, OUT dst_parent_result directory_lookup_result, OUT dst_entry_result dir_entry_result, OUT conflict_name character varying, OUT conflict_cnt integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    src_fsid BIGINT;
    dst_dir_entry dir_lookup_result;
    dst_entry dir_entry_full;
    is_edp_fs BOOLEAN;
BEGIN
    src_fsid := fs_id();
    PERFORM set_path_read_fs(dst_fsid);

    conflict_cnt := 0;
    SELECT * FROM directory_lookup(dst_dir, make_dirs, client_id, FALSE, FALSE,
                                   'CREATE'::version_event) INTO dst_dir_entry;
    dst_parent_result := to_directory_lookup_result(dst_dir_entry);

    EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$
        USING dst_dir_entry, dst_name INTO dst_entry;

    is_edp_fs := fs_is_active_associated_edp(dst_fsid, client_id);

    IF dst_entry.version_id IS NOT NULL THEN
        dst_entry_result := dir_entry_full_to_result(dst_entry);
        IF src_fsid &lt;&gt; dst_fsid OR src_versionid &lt;&gt; dst_entry.version_id THEN
            IF NOT create_conflict AND is_edp_fs = FALSE THEN
                RAISE EXCEPTION 'DESTINATION EXISTS: %', full_path(dst_dir, dst_name);
            ELSIF dst_entry.entry_type = 'DIRECTORY'::entry_type
                    AND dst_entry.entry_type = src_entry_type AND is_edp_fs = FALSE THEN
                RAISE EXCEPTION 'DIRECTORY CONFLICT: %', full_path(dst_dir, dst_name);
            ELSE
                IF is_edp_fs THEN
                    EXECUTE $q$ SELECT directory_entry_delete($1, $2, $3, TRUE, $4) $q$
                        USING dst_dir, dst_name, dst_entry.content_id, client_id;
                ELSIF src_entry_type = 'DIRECTORY'::entry_type THEN
                    EXECUTE $q$SELECT file_rename_as_conflict($1, $2, $3, $4,
                       'CONFLICT'::version_event)$q$
                            USING dst_dir_entry, dst_entry,
                                create_conflict_name(dst_dir_entry, dst_entry.name, client_id),
                                client_id;
                    conflict_cnt := 1;
                ELSE
                    SELECT create_conflict_name(dst_dir_entry, dst_name, client_id) INTO conflict_name;
                END IF;
            END IF;
        END IF;
    END IF;

    IF src_is_create AND (src_fsid &lt;&gt; dst_fsid OR src_dir_entryid &lt;&gt; dst_dir_entry.entry_id) THEN
        EXECUTE $q$SELECT directory_size_update($1, $2, 1)$q$ USING dst_dir_entry.fs_id, dst_dir_entry.version_ctid;
    END IF;

    PERFORM set_path_read_fs(src_fsid);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dest_schema_version_id_reset
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: dest_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dest_schema VARCHAR;
BEGIN
    dest_schema := fsid_to_schema(dest_fsid);
    PERFORM setval(dest_schema || '.version_id_seq', greatest(version_id_next(dest_schema), version_id_next()));
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_full_to_lookup
Schema: fs_func_v120
Result Data Type: dir_lookup_result
Argument Data Types: &quot;full&quot; dir_entry_full
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_lookup_result;
BEGIN
    result := ($1.entry_id, $1.full_path, NULL::TID, $1.fs_id)::dir_lookup_result;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_full_to_result
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: &quot;full&quot; dir_entry_full, storage_id bigint DEFAULT NULL::bigint, storage_path character varying DEFAULT NULL::character varying, all_deletes boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
     RETURN QUERY SELECT $1.parent_path, $1.name, $1.version_id, $1.content_id, $1.entry_type,
           $1.mtime, $1.size, $1.hash, $2, $3, $1.conflict, $1.entry_id,
           CASE WHEN all_deletes THEN FALSE ELSE $1.is_create END, $1.pruned,
           $1.event, $1.timestamp, $1.tsextra, $1.client_id, $1.fs_id, $1.args, $1.is_collapsed,
           $1.move_target_version, $1.sync, NULL::BIGINT, NULL::TIMESTAMPTZ, $1.replaced, dir_entry_full_perms();
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_upsert
Schema: fs_func_v120
Result Data Type: dir_entry
Argument Data Types: parent_entry_id bigint, parent_path character varying, name character varying, entry_type entry_type
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    de dir_entry;
    full_path VARCHAR;
    full_path_entry VARCHAR;
    version_count INTEGER;
BEGIN
    PERFORM limit_entry_name(name);
    full_path := full_path(parent_path, name);
    PERFORM limit_path_length(full_path);
    IF entry_type = 'DIRECTORY' THEN
        full_path_entry := full_path;
    ELSE
        version_count := 0;
    END IF;
    EXECUTE $q$UPDATE dir_entry SET name = $1, full_path = $2
            WHERE parent_entry_id = $3 AND hash(normalize(name)) = hash(normalize($1))
                AND normalize(name) = normalize($1) AND entry_type = $4 RETURNING *$q$
        USING name, full_path_entry, parent_entry_id, entry_type INTO de;
    IF de.entry_id IS NULL THEN
        EXECUTE $q$
                INSERT INTO dir_entry(entry_id, parent_entry_id, name, entry_type, full_path,
                                      version_count)
                    VALUES (entry_id_next(), $1, $2, $3, $4, $5) RETURNING *$q$
            USING parent_entry_id, name, entry_type, full_path_entry, version_count INTO de;
    END IF;
    RETURN de;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directories_lookup_currently_mounted
Schema: fs_func_v120
Result Data Type: SETOF bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT fs_id FROM version WHERE fs_id IS NOT NULL AND is_create = TRUE AND latest = TRUE;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directories_lookup_mountpoints
Schema: fs_func_v120
Result Data Type: SETOF mount_point_result
Argument Data Types: path character varying, inc_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF $2 THEN
        -- get create versions that have latest version id per mountpoint
        RETURN QUERY EXECUTE $q$ SELECT v.fs_id, v.sync, d.full_path
            FROM version v, dir_entry d,
                (SELECT MAX(version_id) version_id FROM version
                    WHERE fs_id IS NOT NULL AND is_create GROUP BY fs_id) m
        WHERE v.version_id = m.version_id
            AND v.entry_id = d.entry_id
            AND ($1 IS NULL OR (hash(normalize(d.full_path)) = hash(normalize($1)) AND normalize(d.full_path) = normalize($1))) $q$
            USING path;
    ELSE
        RETURN QUERY EXECUTE $q$ SELECT v.fs_id, v.sync, d.full_path
            FROM version v, dir_entry d
        WHERE v.fs_id IS NOT NULL AND v.latest = TRUE AND v.is_create = TRUE
            AND v.entry_id = d.entry_id
            AND ($1 IS NULL OR (hash(normalize(d.full_path)) = hash(normalize($1)) AND normalize(d.full_path) = normalize($1))) $q$
        USING path;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directories_lookup_new_mountpoints
Schema: fs_func_v120
Result Data Type: SETOF mount_point_result
Argument Data Types: start timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT v.fs_id, v.sync, d.full_path FROM version v, dir_entry d
        WHERE v.fs_id IS NOT NULL AND v.latest = TRUE AND v.is_create = TRUE
            AND v.mtime &gt;= $1 AND v.entry_id = d.entry_id;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_create
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent_path character varying, dir_name character varying, mtime timestamp with time zone, client_id bigint, implicit_creates boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(v) FROM
            directory_create_int($1, $2, $3, $4, $5, 'CREATE'::version_event) v;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_create_int
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: parent_path character varying, dir_name character varying, mtime timestamp with time zone, client_id bigint, implicit_creates boolean, event version_event
Volatility: volatile
Language: sql
Source Code:

    SELECT *
        FROM version_insert(NULL::BIGINT, NULL::BIGINT, NULL::BIGINT, $1, $2,
            'DIRECTORY'::entry_type, FALSE, FALSE, $3, $4, NULL::BIGINT, NULL::BYTEA, 0,
            NULL::BIGINT, NULL::VARCHAR, NULL::TID, $5, $5, $6, TRUE, FALSE, FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_create_mountpoint
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: fsid bigint, parent_path character varying, name character varying, clientid bigint, sync boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    unique_name VARCHAR;
    insert_result dir_entry_full;
    result VARCHAR;
BEGIN
    SELECT * FROM entry_lookup_by_fs(fsid, FALSE) INTO insert_result;
    IF insert_result.full_path IS NULL THEN
        unique_name := generate_unique_mountpoint_name(parent_path, name);
        insert_result := version_insert(NULL::BIGINT, NULL::BIGINT, NULL::BIGINT, parent_path, unique_name,
                                        'DIRECTORY'::entry_type, FALSE,
                                         FALSE, now(), clientid,
                                         NULL::BIGINT, NULL::BYTEA, 0, fsid, NULL::VARCHAR,
                                         NULL::TID, FALSE, FALSE, 'CREATE'::version_event, sync, FALSE,
                                         FALSE);
    END IF;
    RETURN insert_result.full_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_delete_mountpoint
Schema: fs_func_v120
Result Data Type: dir_entry_result
Argument Data Types: entry dir_entry_full, clientid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_version version;
    parent_dir dir_lookup_result;
    result dir_entry_result;
BEGIN
    parent_dir := directory_lookup(entry.parent_path, FALSE, FALSE);
    EXECUTE $r$
        SELECT * FROM entry_delete($1, FALSE, $2, FALSE, NULL::BIGINT)
    $r$ USING entry, clientid INTO new_version;
    EXECUTE $q$ SELECT directory_size_update($1, $2, -1) $q$ USING parent_dir.fs_id, parent_dir.version_ctid;
    PERFORM filesystem_update_stats(fs_id(), 0, 0, -1, 0, new_version.version_id);
    result := dir_entry_full_to_result(entry);
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_delete_mountpoint_at_path
Schema: fs_func_v120
Result Data Type: dir_entry_result
Argument Data Types: fullpath character varying, clientid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_delete_mountpoint(d, $2) FROM directory_lookup_mounted($1) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_delete_mountpoint_to_fs
Schema: fs_func_v120
Result Data Type: dir_entry_result
Argument Data Types: fsid bigint, clientid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_delete_mountpoint(d, $2) FROM entry_lookup_by_fs($1) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_delete
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: parent character varying, name character varying, contentid bigint, recursive boolean, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    parent_dir dir_lookup_result;
    entry dir_entry_full;
BEGIN
    SELECT * FROM directory_lookup(parent, FALSE, FALSE) INTO parent_dir;
    EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$ USING parent_dir, name INTO entry;
    IF entry.version_id IS NULL THEN
        RETURN FALSE;
    END IF;

    IF entry.parent_entry_id &gt; 0 THEN
        IF NOT recursive AND entry.entry_type = 'DIRECTORY' AND entry.children &gt; 0 THEN
            RAISE EXCEPTION 'DIRECTORY NOT EMPTY: %/%', entry.parent_path, entry.name;
        END IF;
        IF entry.content_id = contentid OR fs_is_edp(entry.fs_id) THEN
            RETURN (SELECT * FROM directory_entry_delete_nocheck(entry, parent_dir, recursive, client_id));
        ELSE
            RETURN NULL;
        END IF;
    END IF;
    RETURN NULL;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_delete_nocheck
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: entry dir_entry_full, parent_dir dir_lookup_result, recursive boolean, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    stats RECORD;
BEGIN
    SELECT * FROM entry_delete_recursive(entry, FALSE, client_id) INTO stats;
    PERFORM filesystem_update_stats(fs_id(), stats.file_count, stats.size_change, stats.dir_count,
            stats.conflict_count, version_id(stats.deleted_version));
    EXECUTE $q$SELECT directory_size_update($1, $2, -1)$q$ USING parent_dir.fs_id, parent_dir.version_ctid;
    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, version_id bigint, pruned boolean, record_read boolean, content_id bigint, client_id bigint, event version_event, args character varying, deleted boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
BEGIN
    EXECUTE $q$ SELECT (de.r).* FROM
        (SELECT dir_entry_full_to_result(elol.el, (elol.ol).storage_id, (elol.ol).path) r
            FROM (
                SELECT el, object_lookup(el.size, el.hash) ol
                    FROM entry_lookup($1, $2, $3, $5) el
                    WHERE ($4 OR NOT pruned)
            ) AS elol) AS de;
    $q$ INTO result USING parent, name, version_id, pruned, deleted;
    IF record_read AND NOT pruned AND result.entry_type = 'FILE'::entry_type AND
        (content_id IS NULL OR content_id &lt;&gt; result.content_id) THEN
        EXECUTE $q$
            SELECT * FROM read_record($1, $2, $3, $4)
        $q$ USING result.version_id, client_id, event, args;
    END IF;
    IF result.version_id IS NOT NULL THEN
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, point_in_time timestamp with time zone, record_read boolean, client_id bigint, event version_event, args character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
BEGIN
    EXECUTE $q$ SELECT (de.r).* FROM
        (SELECT dir_entry_full_to_result(elol.el, (elol.ol).storage_id, (elol.ol).path) r
            FROM (
                SELECT el, object_lookup(el.size, el.hash) ol
                    FROM entry_lookup_at_time($1, $2, $3) el
            ) AS elol) AS de;
    $q$ INTO result USING parent, name, point_in_time;
    IF record_read AND result.entry_type = 'FILE'::entry_type THEN
        EXECUTE $q$
            SELECT * FROM read_record($1, $2, $3, $4)
        $q$ USING result.version_id, client_id, event, args;
    END IF;
    IF result.version_id IS NOT NULL THEN
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_by_version
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: version_id bigint, deleted boolean, pruned boolean, include_latest boolean, entry_type entry_type, record_read boolean, client_id bigint, event version_event, args character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
BEGIN
    EXECUTE $q$ SELECT (de.r).* FROM
        (SELECT dir_entry_full_to_result(elol.el, (elol.ol).storage_id, (elol.ol).path) r
            FROM (
                SELECT el, object_lookup(el.size, el.hash) ol
                    FROM entry_lookup_by_version($1, $2, $3, $4, $5) el
            ) AS elol) AS de;
    $q$ INTO result USING version_id, deleted, pruned, include_latest, entry_type;
    IF record_read AND NOT pruned AND result.entry_type = 'FILE'::entry_type THEN
        EXECUTE $q$
            SELECT * FROM read_record($1, $2, $3, $4)
        $q$ USING result.version_id, client_id, event, args;
    END IF;
    IF result.version_id IS NOT NULL THEN
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_rename
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: src_dir character varying, src_name character varying, contentid bigint, dest_fsid bigint, dest_dir character varying, dest_name character varying, client_id bigint, make_dirs boolean, create_conflict boolean, is_move boolean, event version_event, read_event version_event, read_args character varying, copy_deletes boolean, hide_deletes_earlier_than timestamp with time zone, version_hide boolean, OUT move_result dir_entry_result, OUT dest_mountpoints mount_point_result[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result RECORD;
BEGIN
    EXECUTE
        $q$ SELECT * FROM directory_entry_rename_fast_int($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16) $q$
        USING src_dir, src_name, contentid, dest_fsid, dest_dir, dest_name, client_id,
            make_dirs, create_conflict, is_move, event, read_event, read_args,
            copy_deletes, hide_deletes_earlier_than, version_hide
        INTO result;
    move_result := result.move_result;
    dest_mountpoints := result.dest_mountpoints;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_rename_cleanup
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    ---- DROP FUNCTION ...
    PERFORM drop_rename_functions();
    PERFORM drop_common_move_functions();
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_rename_prepare
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: dest_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM create_common_move_functions(fs_id(), dest_fsid);
    PERFORM create_rename_functions();
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: dir dir_lookup_result, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT $1.full_path, d.*, v.* FROM  dir_entry d, version v
        WHERE $1.entry_id = d.parent_entry_id AND d.entry_id = v.entry_id AND latest = TRUE
            AND ($3 OR is_create) AND ($4 OR NOT v.pruned)
            AND apply_directory_entry_filter($5, v.fs_id, v.sync)
            AND ($2 IS NULL OR d.entry_type = $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM 
        directory_list($1, NULL::entry_type, $2, $3, $4) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list(dl, $2, $3, $4, $5) FROM directory_lookup($1, $3, $4) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: dir dir_lookup_result, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT $1.full_path, d.*, v.* FROM  dir_entry d, version v, user_extract_id(fs_id()) userid
        WHERE $1.entry_id = d.parent_entry_id AND d.entry_id = v.entry_id
            AND timestamp &lt;= $6 AND (replaced IS NULL OR replaced &gt; $6)
            AND ($3 OR is_create) AND ($4 OR NOT v.pruned)
            AND (is_create OR $7 IS NULL OR timestamp &gt; $7)
            AND (is_create OR NOT delete_hide)
            AND apply_directory_entry_filter($5, v.fs_id, v.sync)
            AND ($2 IS NULL OR d.entry_type = $2)
            AND (v.fs_id IS NULL OR sf_is_accessible_at_past_time(v.fs_id, userid));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM
        directory_list_at_time($1, NULL::entry_type, $2, $3, $4, $5, $6) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_at_time(dl, $2, $3, $4, $5, $6, $7) FROM directory_lookup_at_time($1, $3, $4, $6) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_backward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone, show_all_deleted boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e, NULL::BIGINT, NULL::VARCHAR, $9) FROM
        directory_list_at_time_page_backward($1, NULL::entry_type, $2, $3, $4, $5, $6, $7, $8) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_backward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_page_backward(dl, $2, $3, $4, $5, $6, $7, $8, $9)
        FROM directory_lookup_at_time($1, $3, $4, $8) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_forward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone, show_all_deleted boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e, NULL::BIGINT, NULL::VARCHAR, $9) FROM
        directory_list_at_time_page_forward($1, NULL::entry_type, $2, $3, $4, $5, $6, $7, $8) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_forward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_page_forward(dl, $2, $3, $4, $5, $6, $7, $8, $9)
        FROM directory_lookup_at_time($1, $3, $4, $8) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_with_offset
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, offset_cnt integer, page_size integer, entry_collation character varying, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone, show_all_deleted boolean, orderings offset_directory_list_order[]
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e, NULL::BIGINT, NULL::VARCHAR, $10) FROM
        directory_list_at_time_with_offset($1, NULL::entry_type, $2, $3, $4, $5, $6, $7, $8, $9, $11) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_with_offset
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, offset_cnt integer, page_size integer, entry_collation character varying, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone, orderings offset_directory_list_order[]
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_offset(dl, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
        FROM directory_lookup_at_time($1, $3, $4, $9) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_offset
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: dir dir_lookup_result, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, offset_cnt integer, page_size integer, entry_collation character varying, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone, orderings offset_directory_list_order[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    locale_map VARCHAR;
    query VARCHAR;
    order_by VARCHAR;
    ordering offset_directory_list_order;
BEGIN
    locale_map := quote_ident(entry_collation);
    query := $q$SELECT * FROM directory_list($1, $2, $3, $4, $8) AS d $q$;
    IF point_in_time IS NOT NULL THEN
       query := $q$SELECT * FROM directory_list_at_time($1, $2, $3, $4, $8, $9, $10) AS d $q$;
    END IF;
    order_by := $q$ ORDER BY convert_entry_type(d.entry_type) ASC $q$;
    FOREACH ordering IN ARRAY orderings LOOP
        CASE WHEN 'NAME'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, name COLLATE $q$ || locale_map || $q$ ASC $q$;
        WHEN 'NAME_REVERSED'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, name COLLATE $q$ || locale_map || $q$ DESC $q$;
        WHEN 'DATE'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, mtime ASC, tsextra ASC $q$;
        WHEN 'DATE_REVERSED'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, mtime DESC, tsextra DESC $q$;
        WHEN 'SIZE'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, size ASC $q$;
        WHEN 'SIZE_REVERSED'::offset_directory_list_order = ordering THEN
            order_by := order_by || $q$, size DESC $q$;
        ELSE
            -- no additional order_by
        END CASE;
    END LOOP;
    IF (ordering = 'SIZE'::offset_directory_list_order
            OR ordering = 'SIZE_REVERSED'::offset_directory_list_order) THEN
        order_by := order_by || $q$, name COLLATE $q$ || locale_map || $q$ ASC $q$;
    END IF;
    RETURN QUERY EXECUTE (query || order_by || 'LIMIT $5 OFFSET $6')
        USING dir, entry_type, deleted, pruned, offset_cnt, page_size, orderings, filter,
              point_in_time, mountpoint_create_time;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_offset
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, offset_cnt integer, page_size integer, entry_collation character varying, orderings offset_directory_list_order[]
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM 
        directory_list_offset($1, NULL::entry_type, $2, $3, $4, $5, $6, $7, $8) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_offset
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, offset_cnt integer, page_size integer, entry_collation character varying, orderings offset_directory_list_order[]
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_offset(dl, $2, $3, $4, $5, $6, $7, $8, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, $9)
        FROM directory_lookup($1, $3, $4) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_backward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: dir dir_lookup_result, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    locale_map VARCHAR;
    dir_query VARCHAR;
    dir_paging VARCHAR;
    dir_order_by VARCHAR;
    file_query VARCHAR;
    file_paging VARCHAR;
    file_order_by VARCHAR;
    full_query VARCHAR;
BEGIN
    locale_map := quote_ident(token.entry_collation);

    dir_query := $q$ SELECT * FROM directory_list($1, $2, $3, $4, $5) AS dl $q$;
    IF point_in_time IS NOT NULL THEN
        dir_query := $q$ SELECT * FROM directory_list_at_time($1, $2, $3, $4, $5, $8, NULL) AS dl $q$;
    END IF;

    dir_paging := $q$ WHERE 'DIRECTORY'::entry_type = dl.entry_type AND (
                        convert_entry_type($7.last_entry_type) &lt;=
                        convert_entry_type(dl.entry_type)  $q$ ||
                CASE WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$ AND ($7.last_mtime::TIMESTAMPTZ is NULL OR (dl.mtime &lt; $7.last_mtime::TIMESTAMPTZ
                    OR (dl.mtime = $7.last_mtime
                    AND (dl.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$ AND (($7.last_name is NULL)
                    OR (dl.name &lt; $7.last_name COLLATE $q$ || locale_map || $q$)) $q$
               ELSE $q$ AND (($7.last_name is NULL)
                    OR (dl.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)) $q$
                END || $q$ ) $q$;

    dir_order_by := $q$ ORDER BY convert_entry_type(dl.entry_type) ASC $q$ ||
                CASE WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$, mtime DESC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$, name COLLATE $q$ || locale_map || $q$ DESC $q$
                ELSE
                    $q$, name COLLATE $q$ || locale_map || $q$ ASC $q$
                END;

    file_query := $q$ SELECT * FROM directory_list($1, $2, $3, $4, $5) AS d $q$;
    IF point_in_time IS NOT NULL THEN
        file_query := $q$SELECT * FROM directory_list_at_time($1, $2, $3, $4, $5, $8, $9) AS d $q$;
    END IF;

    file_paging := $q$ WHERE 'FILE'::entry_type = d.entry_type AND (
                        convert_entry_type('DIRECTORY'::entry_type) &gt;=
                        convert_entry_type($7.last_entry_type) $q$ ||
                CASE WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$ OR (d.name &lt; $7.last_name COLLATE $q$ || locale_map || $q$) $q$
                WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$ OR ((d.mtime &lt; $7.last_mtime::TIMESTAMPTZ
                    OR (d.mtime = $7.last_mtime
                    AND (d.name &lt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                WHEN 'TYPE_SIZE'::paged_directory_list_order = token.ordering THEN
                    $q$ OR ((d.size &lt; $7.last_size
                    OR (d.size = $7.last_size
                    AND (d.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                END || $q$ ) $q$;

    file_order_by := $q$ ORDER BY convert_entry_type(d.entry_type) ASC $q$ ||
                CASE WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$, name COLLATE $q$ || locale_map || $q$ DESC $q$
                WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$, mtime DESC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                WHEN 'TYPE_SIZE'::paged_directory_list_order = token.ordering THEN
                    $q$, size DESC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                END;

    full_query := 'SELECT * FROM ( ' || dir_query || dir_paging || dir_order_by ||
    ' ) x UNION ALL  SELECT * FROM (' || file_query || file_paging || file_order_by || ') y LIMIT $6';
    RETURN QUERY EXECUTE (full_query)
        USING dir, entry_type, deleted, pruned, filter, page_size, token, point_in_time, mountpoint_create_time;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_backward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM
        directory_list_page_backward($1, NULL::entry_type, $2, $3, $4, $5, $6) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_backward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_page_backward(dl, $2, $3, $4, $5, $6, $7, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ)
        FROM directory_lookup($1, $3, $4) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_forward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: dir dir_lookup_result, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone, mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    locale_map VARCHAR;
    dir_query VARCHAR;
    dir_paging VARCHAR;
    dir_order_by VARCHAR;
    file_query VARCHAR;
    file_paging VARCHAR;
    file_order_by VARCHAR;
    full_query VARCHAR;
BEGIN
    locale_map := quote_ident(token.entry_collation);

    dir_query := $q$ SELECT * FROM directory_list($1, $2, $3, $4, $5) AS dl $q$;
    IF point_in_time IS NOT NULL THEN
        dir_query := $q$ SELECT * FROM directory_list_at_time($1, $2, $3, $4, $5, $8, NULL) AS dl $q$;
    END IF;
    dir_paging := $q$ WHERE 'DIRECTORY'::entry_type = dl.entry_type AND (
                        convert_entry_type($7.last_entry_type) &lt;=
                        convert_entry_type(dl.entry_type)  $q$ ||
                CASE WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$ AND ($7.last_mtime::TIMESTAMPTZ is NULL OR (dl.mtime &gt; $7.last_mtime::TIMESTAMPTZ
                    OR (dl.mtime = $7.last_mtime
                    AND (dl.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                ELSE $q$ AND (($7.last_name is NULL)
                    OR (dl.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)) $q$
                END || $q$ ) $q$;

    dir_order_by := $q$ ORDER BY convert_entry_type(dl.entry_type) ASC $q$ ||
                CASE WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$, mtime ASC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                ELSE $q$, name COLLATE $q$ || locale_map || $q$ ASC $q$
                END;


    file_query := $q$SELECT * FROM directory_list($1, $2, $3, $4, $5) AS d $q$;
    IF point_in_time IS NOT NULL THEN
        file_query := $q$SELECT * FROM directory_list_at_time($1, $2, $3, $4, $5, $8, $9) AS d $q$;
    END IF;

    file_paging := $q$ WHERE 'FILE'::entry_type = d.entry_type AND (
                        convert_entry_type('DIRECTORY'::entry_type) &gt;=
                        convert_entry_type($7.last_entry_type) $q$ ||
                CASE WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$ OR (d.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$) $q$
                WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$ OR ((d.mtime &gt; $7.last_mtime::TIMESTAMPTZ
                    OR (d.mtime = $7.last_mtime
                    AND (d.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                WHEN 'TYPE_SIZE'::paged_directory_list_order = token.ordering THEN
                    $q$ OR ((d.size &gt; $7.last_size
                    OR (d.size = $7.last_size
                    AND (d.name &gt; $7.last_name COLLATE $q$ || locale_map || $q$)))) $q$
                END || $q$ ) $q$;

    file_order_by := $q$ ORDER BY convert_entry_type(d.entry_type) ASC $q$ ||
                CASE WHEN 'TYPE_NAME'::paged_directory_list_order = token.ordering THEN
                    $q$, name COLLATE $q$ || locale_map || $q$ ASC $q$
                WHEN 'TYPE_DATE'::paged_directory_list_order = token.ordering THEN
                    $q$, mtime ASC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                WHEN 'TYPE_SIZE'::paged_directory_list_order = token.ordering THEN
                    $q$, size ASC, name COLLATE $q$ || locale_map || $q$ ASC $q$
                END;

    full_query := 'SELECT * FROM ( ' || dir_query || dir_paging || dir_order_by ||
    ' ) x UNION ALL  SELECT * FROM (' || file_query || file_paging || file_order_by || ') y LIMIT $6';
    RETURN QUERY EXECUTE (full_query)
        USING dir, entry_type, deleted, pruned, filter, page_size, token, point_in_time, mountpoint_create_time;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_forward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM 
        directory_list_page_forward($1, NULL::entry_type, $2, $3, $4, $5, $6) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_forward
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, entry_type entry_type, deleted boolean, pruned boolean, filter directory_entry_filter, page_size integer, token directory_list_page_token
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_list_page_forward(dl, $2, $3, $4, $5, $6, $7, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ)
        FROM directory_lookup($1, $3, $4) dl;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_subdirectories
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(e) FROM directory_list($1, 'DIRECTORY'::entry_type, FALSE,
        FALSE, $2) e;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup
Schema: fs_func_v120
Result Data Type: SETOF dir_lookup_result
Argument Data Types: path_in character varying, deleted boolean, pruned boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM directory_lookup($1, FALSE, NULL::BIGINT, $2, $3, NULL::version_event);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup
Schema: fs_func_v120
Result Data Type: SETOF dir_lookup_result
Argument Data Types: path_in character varying, mkdirs boolean, client_id bigint, deleted boolean, pruned boolean, event version_event
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_lookup_result;
BEGIN
    EXECUTE $q$SELECT * FROM directory_lookup_int($1, $2, $3)$q$ USING path_in, deleted, pruned
        INTO result;
    IF result.entry_id IS NULL THEN
        IF mkdirs THEN
            PERFORM mkdirs(path_in, client_id, event);
            EXECUTE $q$SELECT * FROM directory_lookup_int($1, $2, $3)$q$
                USING path_in, deleted, pruned INTO result;
        ELSE
            RAISE EXCEPTION 'PATH NOT FOUND: %', path_in;
        END IF;
    END IF;
    RETURN NEXT result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_lookup_result
Argument Data Types: path_in character varying, deleted boolean, pruned boolean, point_in_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_lookup_result;
BEGIN
    EXECUTE $q$SELECT * FROM directory_lookup_at_time_int($1, $2, $3, $4)$q$ USING path_in, deleted, pruned, point_in_time
        INTO result;
    IF result.entry_id IS NULL THEN
            RAISE EXCEPTION 'PATH NOT FOUND: %', path_in;
    END IF;
    RETURN NEXT result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_at_time_ext
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, point_in_time timestamp with time zone, deleted boolean, pruned boolean, show_as_deleted boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(d, NULL::BIGINT, NULL::VARCHAR, $5)
        FROM directory_lookup_at_time_full($1, $2, $3, $4) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_at_time_full
Schema: fs_func_v120
Result Data Type: dir_entry_full
Argument Data Types: fullpath character varying, point_in_time timestamp with time zone, deleted boolean DEFAULT false, pruned boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_full;
BEGIN
    EXECUTE $q$
        SELECT ps.parent, d.*, v.* FROM dir_entry d, version v, path_split($1) ps
           WHERE hash(normalize(d.full_path)) = hash(normalize($1))
               AND normalize(d.full_path) = normalize($1) AND d.entry_type = 'DIRECTORY'
               AND d.entry_id = v.entry_id
               AND timestamp &lt;= $4 AND (replaced IS NULL OR replaced &gt; $4)
               AND ($2 OR is_create = TRUE) AND ($3 OR pruned = FALSE)
    $q$ USING fullpath, deleted, pruned, point_in_time INTO result;
    IF result.entry_id IS NULL THEN
        RAISE EXCEPTION 'PATH NOT FOUND: %', fullpath;
    END IF;
    return result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_at_time_int
Schema: fs_func_v120
Result Data Type: dir_lookup_result
Argument Data Types: path character varying, deleted boolean, pruned boolean, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $1 IS NULL THEN
        (-1, '', NULL, NULL)::dir_lookup_result
    ELSE
        (SELECT (d.entry_id, full_path, v.CTID, fs_id)::dir_lookup_result FROM dir_entry d, version v
           WHERE hash(normalize(full_path)) = hash(normalize($1))
               AND normalize(full_path) = normalize($1) AND entry_type = 'DIRECTORY'
               AND d.entry_id = v.entry_id
               AND timestamp &lt;= $4 AND (replaced IS NULL OR replaced &gt; $4)
               AND ($2 OR is_create = TRUE) AND ($3 OR NOT pruned))
    END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_ext
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, deleted boolean, pruned boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(d) FROM directory_lookup_full($1, $2, $3) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_full
Schema: fs_func_v120
Result Data Type: dir_entry_full
Argument Data Types: fullpath character varying, deleted boolean DEFAULT false, pruned boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_full;
BEGIN
    EXECUTE $q$
        SELECT ps.parent, d.*, v.* FROM dir_entry d, version v, path_split($1) ps
           WHERE hash(normalize(d.full_path)) = hash(normalize($1))
               AND normalize(d.full_path) = normalize($1) AND d.entry_type = 'DIRECTORY'
               AND d.entry_id = v.entry_id AND latest = TRUE
               AND ($2 OR is_create = TRUE) AND ($3 OR pruned = FALSE)
    $q$ USING fullpath, deleted, pruned INTO result;
    IF result.entry_id IS NULL THEN
        RAISE EXCEPTION 'PATH NOT FOUND: %', fullpath;
    END IF;
    return result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_int
Schema: fs_func_v120
Result Data Type: dir_lookup_result
Argument Data Types: path character varying, deleted boolean, pruned boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $1 IS NULL THEN
        (-1, '', NULL, NULL)::dir_lookup_result
    ELSE
        (SELECT (d.entry_id, full_path, v.CTID, fs_id)::dir_lookup_result FROM dir_entry d, version v
           WHERE hash(normalize(full_path)) = hash(normalize($1))
               AND normalize(full_path) = normalize($1) AND entry_type = 'DIRECTORY'
               AND d.entry_id = v.entry_id AND latest = TRUE
               AND ($2 OR is_create = TRUE) AND ($3 OR NOT pruned))
    END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_mounted
Schema: fs_func_v120
Result Data Type: dir_entry_full
Argument Data Types: fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_entry dir_entry_full;
BEGIN
    current_entry := directory_lookup_full(fullpath);
    IF current_entry.fs_id IS NULL THEN
       RAISE EXCEPTION 'DIRECTORY NOT SHARED: %', fullpath;
    END IF;
    RETURN current_entry;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_mounted_fsid
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: fullpath character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT fs_id FROM directory_lookup_mounted($1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_mounted_path
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $1 = fs_id() THEN
        '/'::VARCHAR
    ELSE
        (entry_lookup_by_fs($1)).full_path
    END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_unmounted
Schema: fs_func_v120
Result Data Type: dir_entry_full
Argument Data Types: fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_entry dir_entry_full;
BEGIN
    current_entry := directory_lookup_full(fullpath);
    IF current_entry.fs_id IS NOT NULL THEN
       RAISE EXCEPTION 'DIRECTORY ALREADY SHARED: %', fullpath;
    END IF;
    RETURN current_entry;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_restore
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying, delta integer, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(res.def)
        FROM (
            SELECT filesystem_update_stats(fs_id(), (drr.r).file_count, (drr.r).size_change,
                    (drr.r).dir_count, (drr.r).conflict_count, (drr.r).latest_restored_version_id), drr.def
                FROM (
                    SELECT directory_restore_recursive(dci.r,
                                (dci.dlf).timestamp - ($2 || 'seconds')::interval, $3, (dci.r).version_id) r,
                            dci.r def
                        FROM (
                            SELECT directory_create_int(dlf.parent_path, dlf.name, dlf.mtime, $3,
                                    TRUE, 'RESTORE'::version_event) r, dlf
                                FROM directory_lookup_full($1, TRUE) dlf WHERE is_create = FALSE
                        ) AS dci
                ) AS drr
        ) res;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_restore_recursive
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: parent dir_entry_full, replaced_after timestamp with time zone, client_id bigint, INOUT latest_restored_version_id bigint, OUT file_count integer, OUT size_change bigint, OUT dir_count integer, OUT conflict_count integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    children INTEGER := 0;
    def dir_entry_full;
    result RECORD;
    parent_lookup dir_lookup_result;
    child_der dir_entry_result;
BEGIN
    file_count := 0;
    size_change := 0;
    dir_count := 0;
    conflict_count := 0;
    parent_lookup := dir_entry_full_to_lookup(parent);
    FOR def IN EXECUTE $q$
                SELECT $3, d.*, v.* FROM dir_entry d, version v
                    WHERE parent_entry_id = $1 AND d.entry_id = v.entry_id AND timestamp &gt; $2
                        AND NOT is_create AND latest AND v.event &lt;&gt; 'UNSHARE'::version_event AND NOT pruned
            $q$ USING parent.entry_id, replaced_after, parent.full_path
    LOOP
        IF def.entry_type = 'DIRECTORY'::entry_type AND def.fs_id IS NOT NULL THEN
            -- it's a DELETE (move) mountpoint record.  We can't restore cross-fs, so skip it.
        ELSE
            child_der := dir_entry_full_to_result(def);
            SELECT * FROM entry_restore(child_der, parent_lookup, def.name, client_id, TRUE) INTO result;
            file_count := file_count + result.file_count;
            size_change := size_change + result.size_change;
            dir_count := dir_count + result.dir_count;
            conflict_count := conflict_count + result.conflict_count;
            children := children + result.child_count;
            latest_restored_version_id := (result.result).version_id;

            IF def.entry_type = 'DIRECTORY'::entry_type THEN
                SELECT *
                    FROM directory_restore_recursive(result.result, replaced_after, client_id, latest_restored_version_id)
                    INTO result;
                file_count := file_count + result.file_count;
                size_change := size_change + result.size_change;
                dir_count := dir_count + result.dir_count;
                conflict_count := conflict_count + result.conflict_count;
                latest_restored_version_id := result.latest_restored_version_id;
            END IF;
        END IF;
    END LOOP;

    EXECUTE $q$UPDATE version SET children = $3
            WHERE version_id = $1 AND ($3 &lt;= 0 OR limit_directory_entries($2, $3));$q$
        USING parent.version_id, parent.fs_id, children;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_share
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: fullpath character varying, clientid bigint, fsid bigint, OUT share_fsid bigint, OUT new_version_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_entry dir_entry_full;
    new_version version;
BEGIN
    -- find the directory and make sure it is not already shared
    current_entry := directory_lookup_unmounted(fullpath);

    -- insert a version that shares the directory
    EXECUTE $s$
        SELECT * FROM insert_latest_version($1, TRUE, FALSE, FALSE, FALSE, 'SHARE'::version_event, now(),
            $2, NULL::BIGINT, NULL::BYTEA, NULL::INTEGER, $4,
            NULL::VARCHAR, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT, $3, TRUE, FALSE)
    $s$ USING current_entry.entry_id, clientid, current_entry.content_id, fsid INTO new_version;

    share_fsid := new_version.fs_id;
    new_version_id := new_version.version_id;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_size_update
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: fs_id bigint, ctid tid, change integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE version SET children = children + $3
        WHERE CTID = $2 AND ($3 &lt;= 0 OR limit_directory_entries($1, children + $3));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_unshare
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: fullpath character varying, clientid bigint, OUT share_fsid bigint, OUT new_version_id bigint, OUT mountpoint_create_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_entry dir_entry_full;
    new_version version;
BEGIN
    -- find the directory and make sure it is shared
    current_entry := directory_lookup_mounted(fullpath);

    EXECUTE $r$
        SELECT * FROM insert_latest_version($1, TRUE, FALSE, FALSE, FALSE, 'UNSHARE'::version_event, now(),
            $2, NULL::BIGINT, NULL::BYTEA, 0, NULL::BIGINT,
            NULL::VARCHAR, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT, $3, TRUE, FALSE)
    $r$ USING current_entry.entry_id, clientid, current_entry.content_id INTO new_version;

    share_fsid := current_entry.fs_id;
    new_version_id := new_version.version_id;
    mountpoint_create_time := current_entry.timestamp;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_update_latest_version
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: fullpath character varying, deleted boolean, fs_id bigint, is_collapsed boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT update_latest_version(d.entry_id, $3, $4) FROM directory_lookup_int($1, $2, FALSE) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: drop_common_move_functions
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    DROP FUNCTION IF EXISTS dest_dir_entry_upsert_fast(in_parent_entry_id BIGINT,
                                                       in_parent_path VARCHAR, in_name VARCHAR,
                                                       in_entry_type entry_type, thelimits limits,
                                                       OUT de dir_entry, OUT de_created BOOLEAN);
    DROP FUNCTION IF EXISTS dest_insert_latest_version_fast(in_entry_id BIGINT, is_create BOOLEAN,
                                                            pruned BOOLEAN, conflict BOOLEAN,
                                                            activity_hide BOOLEAN,
                                                            event version_event, mtime TIMESTAMPTZ,
                                                            client_id BIGINT, size BIGINT,
                                                            hash BYTEA, children INTEGER,
                                                            fs_id BIGINT, args VARCHAR,
                                                            replaced TIMESTAMPTZ,
                                                            is_collapsed BOOLEAN,
                                                            move_target_version BIGINT,
                                                            contentid BIGINT, is_new_entry BOOLEAN,
                                                            sync BOOLEAN,
                                                            version_hide BOOLEAN, delete_hide BOOLEAN);
    DROP FUNCTION IF EXISTS src_insert_latest_version_fast(in_entry_id BIGINT, in_is_create BOOLEAN,
                                                           in_pruned BOOLEAN, in_conflict BOOLEAN,
                                                           in_activity_hide BOOLEAN, in_event version_event,
                                                           in_mtime TIMESTAMPTZ, in_client_id BIGINT, in_size BIGINT,
                                                           in_hash BYTEA, in_children INTEGER, in_fs_id BIGINT,
                                                           in_args VARCHAR, unused_replaced TIMESTAMPTZ,
                                                           in_is_collapsed BOOLEAN, in_move_target_version BIGINT,
                                                           in_contentid BIGINT, is_new_entry BOOLEAN, sync BOOLEAN,
                                                           version_hide BOOLEAN);
    DROP FUNCTION IF EXISTS dest_version_id_next();
    DROP FUNCTION IF EXISTS dest_entry_id_next();
    DROP FUNCTION IF EXISTS src_version_id_next();
    DROP FUNCTION IF EXISTS src_entry_id_next();

END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: drop_filesystem
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    filesystem_schema VARCHAR;
BEGIN
    filesystem_schema := fsid_to_schema(fs_id);

    IF EXISTS(SELECT schema_name FROM information_schema.schemata
            WHERE schema_name = filesystem_schema) THEN
        EXECUTE 'DROP SCHEMA ' || filesystem_schema || ' CASCADE';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: drop_rename_functions
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    DROP FUNCTION IF EXISTS directory_entry_rename_fast_int(src_dir VARCHAR, src_name VARCHAR,
                                                            contentid BIGINT, dest_fsid BIGINT,
                                                            dest_dir VARCHAR, dest_name VARCHAR,
                                                            client_id BIGINT, make_dirs BOOLEAN,
                                                            create_conflict BOOLEAN,
                                                            is_move BOOLEAN,
                                                            event version_event, read_event version_event, read_args VARCHAR,
                                                            copy_deletes BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ,
                                                            version_hide BOOLEAN,
                                                            OUT move_result dir_entry_result,
                                                            OUT dest_mountpoints mount_point_result ARRAY);


    DROP FUNCTION IF EXISTS src_entry_delete_fast(entry dir_entry_full, hidden BOOLEAN, client_id BIGINT,
                                                  is_collapsed BOOLEAN, move_target_version BIGINT,
                                                  version_hide BOOLEAN);

    DROP FUNCTION IF EXISTS entry_rename_recursive(src dir_entry_full, src_fsid BIGINT,
                                                   dest_fsid BIGINT,
                                                   dest_dir directory_lookup_result,
                                                   dest_name VARCHAR, conflict BOOLEAN,
                                                   hidden BOOLEAN, client_id BIGINT,
                                                   cross_fs BOOLEAN, is_move BOOLEAN,
                                                   event version_event, read_event version_event, read_args VARCHAR,
                                                   thelimits limits, copy_deletes BOOLEAN,
                                                   hide_deletes_earlier_than TIMESTAMPTZ, version_hide BOOLEAN,
                                                   INOUT stats cross_fs_file_stats,
                                                   OUT renamed dir_entry_result,
                                                   OUT dest_mountpoints mount_point_result ARRAY);

    DROP FUNCTION IF EXISTS dest_dir_entry_copy_fast(src dir_entry_full, src_fsid BIGINT,
                                                     dest_fsid BIGINT,
                                                     dest_dir directory_lookup_result,
                                                     dest_name VARCHAR, conflict BOOLEAN,
                                                     hidden BOOLEAN, event version_event,
                                                     client_id BIGINT, args VARCHAR,
                                                     copy_shareid BOOLEAN, thelimits limits,
                                                     version_hide BOOLEAN, hide_deletes_earlier_than TIMESTAMPTZ);

    DROP FUNCTION IF EXISTS dest_version_copy_fast(src dir_entry_full, entry_id BIGINT,
                                                   conflict BOOLEAN, hidden BOOLEAN,
                                                   event version_event, client_id BIGINT,
                                                   args VARCHAR, shareid BIGINT, content_id BIGINT,
                                                   is_new_entry BOOLEAN, version_hide BOOLEAN,
                                                   hide_deletes_earlier_than TIMESTAMPTZ);

    DROP FUNCTION IF EXISTS dest_version_copy_same_contentid_fast(src dir_entry_full,
                                                                  entry_id BIGINT, conflict BOOLEAN,
                                                                  hidden BOOLEAN,
                                                                  event version_event,
                                                                  client_id BIGINT, args VARCHAR,
                                                                  shareid BIGINT,
                                                                  is_new_entry BOOLEAN,
                                                                  version_hide BOOLEAN,
                                                                  hide_deletes_earlier_than TIMESTAMPTZ);

    DROP FUNCTION IF EXISTS dest_dir_entry_copy_fast(src dir_entry_full,
                                                     dest_dir directory_lookup_result,
                                                     dest_name VARCHAR, conflict BOOLEAN,
                                                     hidden BOOLEAN, event version_event,
                                                     client_id BIGINT, args VARCHAR, shareid BIGINT,
                                                     thelimits limits, version_hide BOOLEAN,
                                                     hide_deletes_earlier_than TIMESTAMPTZ);

    DROP FUNCTION IF EXISTS src_directory_list_fast(dir dir_lookup_result, in_entry_type entry_type,
                                                    in_deleted BOOLEAN, in_pruned BOOLEAN);

END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_delete_under_path
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: path character varying
Volatility: volatile
Language: sql
Source Code:

    WITH RECURSIVE entry(entry_id) AS (
        SELECT d.entry_id
            FROM dir_entry d, directory_lookup_full($1, TRUE) p
            WHERE d.parent_entry_id = p.entry_id
        UNION ALL
        SELECT d.entry_id
            FROM dir_entry d, entry p
            WHERE d.parent_entry_id = p.entry_id
    ) DELETE FROM dir_entry WHERE entry_id IN (SELECT entry_id FROM entry);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_delete_version_and_reads
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: versionid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF versionid IS NOT NULL THEN
        EXECUTE $q$ DELETE FROM version_read
            WHERE version_id = $1 AND event = 'READ'::version_event $q$ USING versionid;
        EXECUTE $q$ DELETE FROM version_read
            WHERE version_id = $1 AND event &lt;&gt; 'READ'::version_event $q$ USING versionid;
        EXECUTE $q$ DELETE FROM version WHERE version_id = $1 $q$ USING versionid;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: basedir character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM entries_find_recursive($1, '%' || regexp_replace(normalize($2), '[%|_]', '\\\&amp;', 'g') || '%',
                                         $3, $4, $5);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: basedir character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM entries_find_at_time_recursive($1, '%' || regexp_replace(normalize($2), '[%|_]', '\\\&amp;', 'g') || '%',
                                                 $3, $4, $5, $6);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_at_time_recursive
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: basedir character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    WITH RECURSIVE dir_entry_full AS (
        SELECT *
            FROM directory_list_at_time(directory_lookup_at_time_int($1, $3, FALSE, $6), NULL::entry_type, $3,
                FALSE, $5, $6, NULL) d
            WHERE normalize(d.name) LIKE $2 OR d.entry_type = 'DIRECTORY'::entry_type
        UNION ALL
        SELECT df.full_path, d.*, v.*
            FROM dir_entry d, version v, dir_entry_full df
            WHERE d.parent_entry_id = df.entry_id
                AND v.timestamp &lt;= $6 AND (v.replaced IS NULL OR v.replaced &gt; $6)
                AND ($3 OR v.is_create)
                AND (normalize(d.name) LIKE $2 OR d.entry_type = 'DIRECTORY'::entry_type)
                AND d.entry_id = v.entry_id
                AND apply_directory_entry_filter($5, v.fs_id, v.sync)
    ) SELECT dir_entry_full_to_result(df) FROM dir_entry_full df
        WHERE normalize(name) LIKE $2 ORDER BY name, mtime DESC LIMIT $4;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_conflicts
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(c)
        FROM (SELECT d.full_path, dv.*
            FROM (SELECT * FROM dir_entry d, version v
                WHERE latest = TRUE AND conflict = TRUE AND d.entry_id = v.entry_id) AS dv,
            dir_entry d WHERE d.entry_id = dv.parent_entry_id) AS c;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_recursive
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: basedir character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    WITH RECURSIVE dir_entry_full AS (
        SELECT *
            FROM directory_list(directory_lookup_int($1, $3, FALSE), NULL::entry_type, $3,
                FALSE, $5) d
            WHERE normalize(d.name) LIKE $2 OR d.entry_type = 'DIRECTORY'::entry_type
        UNION ALL
        SELECT df.full_path, d.*, v.*
            FROM dir_entry d, version v, dir_entry_full df
            WHERE d.parent_entry_id = df.entry_id AND v.latest = TRUE AND ($3 OR v.is_create)
                AND (normalize(d.name) LIKE $2 OR d.entry_type = 'DIRECTORY'::entry_type)
                AND d.entry_id = v.entry_id
                AND apply_directory_entry_filter($5, v.fs_id, v.sync)
    ) SELECT dir_entry_full_to_result(df) FROM dir_entry_full df
        WHERE normalize(name) LIKE $2 ORDER BY name, mtime DESC LIMIT $4;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_lookup_all
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: path character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    entries VARCHAR[];
    name VARCHAR;
    result dir_entry_full;
    parent dir_lookup_result;
BEGIN
    EXECUTE $q$SELECT * FROM directory_lookup_int('/', FALSE, FALSE)$q$ INTO parent;
    entries := path_to_array(path);
    FOREACH name IN ARRAY entries LOOP
        EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL::BIGINT)$q$ USING parent, name INTO result;
        IF result.version_id IS NULL THEN
            RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(parent.full_path, name);
        END IF;
        RETURN QUERY SELECT * FROM dir_entry_full_to_result(result);
        parent := (result.entry_id, result.full_path, NULL::TID, result.fs_id)::dir_lookup_result;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_lookup_mountpoints_under_path
Schema: fs_func_v120
Result Data Type: SETOF mount_point_result
Argument Data Types: path character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT (v.fs_id, v.sync, d.full_path)::mount_point_result
        FROM dir_entry d, version v
        WHERE fs_id IS NOT NULL AND is_create = TRUE AND latest = TRUE AND
            v.entry_id = d.entry_id AND
                (normalize(full_path) = normalize($1) OR
                 normalize(full_path) LIKE normalize($1) || '/%')
        ORDER BY v.fs_id;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_lookup_mountpoints_under_path_at_time
Schema: fs_func_v120
Result Data Type: SETOF mount_point_result
Argument Data Types: path character varying, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT (v.fs_id, v.sync, d.full_path)::mount_point_result
        FROM dir_entry d, version v
        WHERE fs_id IS NOT NULL
            AND timestamp &lt;= $2 AND (replaced IS NULL OR replaced &gt; $2)
            AND is_create = TRUE
            AND v.entry_id = d.entry_id
            AND ($1 = '/' OR normalize(full_path) = normalize($1) OR
                 normalize(full_path) LIKE normalize($1) || '/%')
        ORDER BY v.fs_id;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_copy_all
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: dst_fsid bigint, dst_dir character varying, client_id bigint, make_dirs boolean, create_conflict boolean, read_event version_event, read_args character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT directory_entry_rename_prepare($1);
    SELECT directory_entry_rename(src.parent_path, src.name, src.content_id, $1, $2, src.name,
            $3, $4, $5, FALSE, NULL::version_event, $6, $7, FALSE, NULL::TIMESTAMPTZ, FALSE)
        FROM directory_list(directory_lookup_int('/', FALSE, FALSE), NULL, FALSE, FALSE,
            'ALL_ENTRIES'::directory_entry_filter) src;
    SELECT directory_entry_rename_cleanup();
    SELECT TRUE;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_copy_path
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: src_parent character varying, src_name character varying, dst_fsid bigint, dst_dir character varying, client_id bigint, make_dirs boolean, create_conflict boolean, read_event version_event, read_args character varying, OUT copy_result dir_entry_result, OUT dest_mountpoints mount_point_result[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
     src dir_entry_full;
     result RECORD;
BEGIN
    SELECT * FROM entry_lookup(src_parent, src_name, NULL) INTO src;
    PERFORM directory_entry_rename_prepare(dst_fsid);
    EXECUTE
            $q$ SELECT * FROM directory_entry_rename($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16) $q$
        USING src.parent_path, src.name, src.content_id, dst_fsid, dst_dir, src.name, client_id, make_dirs,
              create_conflict, FALSE, NULL::version_event, read_event, read_args, FALSE, NULL::TIMESTAMPTZ, FALSE
        INTO result;
    PERFORM directory_entry_rename_cleanup();
    copy_result := result.move_result;
    dest_mountpoints := result.dest_mountpoints;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_delete
Schema: fs_func_v120
Result Data Type: version
Argument Data Types: entry dir_entry_full, hidden boolean, client_id bigint, is_collapsed boolean, move_target_version bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE dir_entry SET version_count = version_count + 1 WHERE entry_id = $1.entry_id
        AND entry_type = 'FILE'::entry_type;
    SELECT * FROM insert_latest_version($1.entry_id, FALSE, FALSE, FALSE, $2, 'DELETE'::version_event,
        $1.mtime, $3, $1.size, $1.hash, NULL::INTEGER, $1.fs_id, NULL::VARCHAR, now(), $4, $5,
        content_id_next(), $1.sync, FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_delete_all
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT entry_delete_recursive(d, TRUE, $1)
        FROM directory_list(directory_lookup_int('/'::VARCHAR, FALSE, FALSE), NULL, FALSE, FALSE,
            'ALL_ENTRIES'::directory_entry_filter) d;
    UPDATE version SET children = 0 WHERE entry_id = 1 AND latest = TRUE;
    SELECT TRUE;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_delete_recursive
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: entry dir_entry_full, hidden boolean, client_id bigint, OUT file_count integer, OUT size_change bigint, OUT dir_count integer, OUT conflict_count integer, OUT deleted_version version
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    stats RECORD;
    sub_entry dir_entry_full;
    is_collapsed BOOLEAN := TRUE;
BEGIN
    IF entry.entry_type = 'DIRECTORY'::entry_type THEN
        dir_count := -1;
        file_count := 0;
        size_change := 0;
        conflict_count := 0;
        FOR sub_entry IN EXECUTE
                $q$SELECT * FROM directory_list(($1, $2, NULL::TID, $3)::dir_lookup_result,
                        NULL::entry_type, FALSE, FALSE, 'ALL_ENTRIES'::directory_entry_filter)$q$
                USING entry.entry_id, entry.full_path, entry.fs_id LOOP
            SELECT * FROM entry_delete_recursive(sub_entry, TRUE, client_id) INTO stats;
            file_count := file_count + stats.file_count;
            size_change := size_change + stats.size_change;
            dir_count := dir_count + stats.dir_count;
            conflict_count := conflict_count + stats.conflict_count;
        END LOOP;
        IF entry.fs_id IS NOT NULL THEN
            is_collapsed := FALSE;
        END IF;
    ELSE
        file_count := -1;
        size_change = -entry.size;
        IF entry.conflict THEN
            conflict_count := -1;
        ELSE
            conflict_count := 0;
        END IF;
        dir_count := 0;
    END IF;
    EXECUTE $q$SELECT * FROM entry_delete($1, $2, $3, $4, NULL::BIGINT)$q$
        USING entry, hidden, client_id, is_collapsed
        INTO deleted_version;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_full_path
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: parent_entry_id bigint, name character varying, full_path character varying
Volatility: stable
Language: sql
Source Code:

    SELECT CASE WHEN $3 IS NULL THEN
        (SELECT full_path(full_path, $2) FROM dir_entry WHERE entry_id = $1)
    ELSE
        $3
    END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_get_size_at_time
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: parent character varying, name character varying, point_in_time timestamp with time zone, OUT size bigint, OUT mountpoints mount_point_result[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    parent_dir dir_lookup_result;
    entry dir_entry_full;
    result RECORD;
BEGIN
    IF point_in_time IS NULL THEN
        EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$ USING parent, name INTO entry;
    ELSE
        EXECUTE $q$SELECT * FROM entry_lookup_at_time($1, $2, $3)$q$ USING parent, name, point_in_time INTO entry;
    END IF;
    IF entry.version_id IS NULL THEN
        RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(parent, name);
    END IF;

    SELECT * FROM entry_get_size_at_time_recursive(entry, point_in_time) INTO result;
    size := result.size;
    mountpoints := result.mountpoints;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_get_size_at_time_recursive
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: entry dir_entry_full, point_in_time timestamp with time zone, OUT size bigint, OUT mountpoints mount_point_result[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result RECORD;
    sub_entry dir_entry_full;
    sublist_query VARCHAR;
BEGIN
    mountpoints := '{}';  -- empty array

    IF entry.entry_type = 'DIRECTORY'::entry_type THEN
        size := 0;
        IF entry.fs_id IS NOT NULL THEN
            -- return the destination for the mountpoint
            mountpoints := array_append(mountpoints,
                    (entry.fs_id, entry.sync, full_path(entry.parent_path, entry.name))::mount_point_result);
        ELSE
            IF point_in_time IS NULL THEN
                sublist_query :=
                    $q$ SELECT * FROM directory_list(dir_entry_full_to_lookup($1),
                                 NULL::entry_type, FALSE, FALSE, 'AW_ONLY'::directory_entry_filter) $q$;
            ELSE
                sublist_query :=
                    $q$ SELECT * FROM directory_list_at_time(dir_entry_full_to_lookup($1),
                            NULL::entry_type, FALSE, FALSE, 'AW_ONLY'::directory_entry_filter, $2, NULL) $q$;
            END IF;
            FOR sub_entry IN EXECUTE sublist_query USING entry, point_in_time
            LOOP
                SELECT * FROM entry_get_size_at_time_recursive(sub_entry, point_in_time) INTO result;
                size := size + result.size;
                mountpoints := array_cat(mountpoints, result.mountpoints);
            END LOOP;
        END IF;
    ELSE
        size = entry.size;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_id_next
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('entry_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: parent character varying, name character varying, version_id bigint, deleted boolean DEFAULT false
Volatility: volatile
Language: sql
Source Code:

     SELECT entry_lookup(d, $2, $3, $4) FROM directory_lookup_int($1, TRUE, FALSE) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: parent_dir dir_lookup_result, name character varying, version_id bigint, deleted boolean DEFAULT false
Volatility: volatile
Language: sql
Source Code:

     SELECT $1.full_path, * FROM dir_entry de, version v
         WHERE parent_entry_id = $1.entry_id AND hash(normalize(name)) = hash(normalize($2))
             AND normalize(name) = normalize($2) AND de.entry_id = v.entry_id
             AND (($3 IS NULL AND latest = TRUE AND ($4 OR is_create = TRUE))
                  OR (version_id = $3))

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: parent character varying, name character varying, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT entry_lookup_at_time(d, $2, $3) FROM directory_lookup_at_time_int($1, FALSE, FALSE, $3) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_at_time
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: parent_dir dir_lookup_result, name character varying, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

     SELECT $1.full_path, * FROM dir_entry de, version v
         WHERE parent_entry_id = $1.entry_id AND hash(normalize(name)) = hash(normalize($2))
             AND normalize(name) = normalize($2) AND de.entry_id = v.entry_id
             AND is_create = TRUE
             AND timestamp &lt;= $3 AND (replaced IS NULL OR replaced &gt; $3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_at_time_ext
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(v) FROM entry_lookup_at_time($1, $2, $3) v;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_by_fs
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT entry_lookup_by_fs($1, TRUE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_by_fs
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: fsid bigint, throw boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_full;
BEGIN
    EXECUTE $q$
        SELECT parent.full_path, mountpoint.*, v.*
        FROM version v, dir_entry mountpoint, dir_entry parent
        WHERE v.fs_id = $1
            AND v.fs_id IS NOT NULL
            AND v.latest = TRUE and v.is_create = TRUE
            AND v.entry_id = mountpoint.entry_id
            AND mountpoint.parent_entry_id = parent.entry_id
    $q$ USING fsid INTO result;
    IF result.entry_id IS NULL AND throw THEN
        RAISE EXCEPTION 'FILESYSTEM MOUNT POINT NOT FOUND';
    END IF;
    RETURN NEXT result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_by_fs_result
Schema: fs_func_v120
Result Data Type: dir_entry_result
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(elbf.*) FROM entry_lookup_by_fs($1) elbf;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_by_version
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: version_id bigint, deleted boolean, pruned boolean, include_latest boolean, entry_type entry_type
Volatility: volatile
Language: sql
Source Code:

    SELECT parent.full_path, d.*, v.*
        FROM version v, dir_entry d, dir_entry parent
        WHERE v.version_id = $1
            AND v.entry_id = d.entry_id
            AND d.parent_entry_id = parent.entry_id
            AND ($2 OR is_create)
            AND ($3 OR NOT pruned)
            AND ($4 OR NOT latest)
            AND ($5 IS NULL OR d.entry_type = $5);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_corresponding_mount
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, unmount_version_id bigint, pruned boolean
Volatility: volatile
Language: sql
Source Code:

    WITH unmount_version AS (
        SELECT parent_path, entry_id, fs_id
            FROM entry_lookup_by_version($3, TRUE, $4, TRUE, NULL::entry_type) elbv
            WHERE fs_id IS NOT NULL AND NOT is_create AND parent_path = $1 AND name = $2
    ), mount_version AS (
        SELECT MAX(version_id) version_id
            FROM version v, unmount_version u
            WHERE v.entry_id = u.entry_id AND v.is_create
                AND v.fs_id = u.fs_id AND v.version_id &lt; $3
    ) SELECT dir_entry_full_to_result((u.parent_path, d.*, v.*)::dir_entry_full)
            FROM version v, dir_entry d, unmount_version u, mount_version m
            WHERE v.version_id = m.version_id
                AND v.entry_id = d.entry_id
                AND ($4 OR NOT pruned);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_ext
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, deleted boolean
Volatility: volatile
Language: sql
Source Code:

     SELECT dir_entry_full_to_result(r.e) FROM (
         SELECT entry_lookup(d, $2, NULL::BIGINT, $3) e FROM directory_lookup_int($1, TRUE, FALSE) d
     ) r

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_lookup_first_mountpoint
Schema: fs_func_v120
Result Data Type: SETOF character varying
Argument Data Types: fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mounted_path VARCHAR;
BEGIN
    EXECUTE $q$
        SELECT full_path(parent.full_path, mountpoint.name)
        FROM version v, dir_entry mountpoint, dir_entry parent
        WHERE v.fs_id = $1
            AND v.fs_id IS NOT NULL
            AND v.is_create = TRUE
            AND v.entry_id = mountpoint.entry_id
            AND mountpoint.parent_entry_id = parent.entry_id
        ORDER BY v.timestamp
        LIMIT 1;
    $q$ USING fsid INTO mounted_path;
    IF mounted_path IS NULL OR length(mounted_path) &lt; 1 THEN
        RAISE EXCEPTION 'FILESYSTEM MOUNT POINT NOT FOUND';
    END IF;
    RETURN NEXT mounted_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_restore
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: src_entry dir_entry_result, dest_parent_dir dir_lookup_result, dest_name character varying, client_id bigint, hide boolean, OUT result dir_entry_full, OUT file_count integer, OUT size_change bigint, OUT dir_count integer, OUT conflict_count integer, OUT child_count integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_entry dir_entry_full;
    de dir_entry_type;
    conflict BOOLEAN := src_entry.conflict;
    args VARCHAR := src_entry.args;
    new_version version_type;
BEGIN
    dir_count := 0;
    file_count := 0;
    size_change := 0;
    conflict_count := 0;
    child_count := 1;

    EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$
        USING dest_parent_dir, dest_name INTO current_entry;
    IF current_entry.entry_id IS NULL THEN
        -- restoring a path that does not currently exist; we will recreate it
        IF src_entry.entry_type = 'DIRECTORY'::entry_type THEN
            dir_count := 1;
        ELSE
            file_count := 1;
            size_change := src_entry.size;
        END IF;
    ELSIF current_entry.entry_type = src_entry.entry_type THEN
        -- the path currently exists as the same type
        child_count := 0;
        IF src_entry.entry_type = 'DIRECTORY'::entry_type THEN
            -- it's a directory and it already exists, so we're done
            result := current_entry;
            RETURN;
        END IF;
        -- we're going to add a new version of the file
        EXECUTE $q$ UPDATE dir_entry SET version_count = version_count + 1 WHERE entry_id = $1 $q$
            USING current_entry.entry_id;
        size_change := src_entry.size - current_entry.size;
    ELSE
        -- the path exists as a different type
        IF src_entry.entry_type = 'DIRECTORY'::entry_type THEN
            -- it is currently a file, and we want to restore it as a directory, so rename the current file
            EXECUTE $q$SELECT file_rename_as_conflict($1, $2, $3, $4, 'RESTORE'::version_event)$q$
                        USING dest_parent_dir, current_entry,
                            create_conflict_name(dest_parent_dir, current_entry.name, client_id),
                            client_id;
            dir_count := 1;
        ELSE
            -- it is currently a directory, and we want to restore it as a file, so the restored file will get a conflict name
            dest_name := create_conflict_name(dest_parent_dir, dest_name, client_id);
            conflict := TRUE;
            args := array_to_args(dest_name);
            file_count := 1;
            size_change := src_entry.size;
        END IF;
        conflict_count := 1;
    END IF;

    -- insert a the dir_entry row if necessary
    de := dir_entry_upsert(dest_parent_dir.entry_id, dest_parent_dir.full_path, dest_name, src_entry.entry_type);

    -- insert new version
    EXECUTE $q$
        SELECT * FROM version_copy($1, $2, $3, $4, 'RESTORE'::version_event, $5, $6, NULL::BIGINT, 0)
    $q$ USING src_entry, de.entry_id, conflict, hide, client_id, args INTO new_version;
    result := (dest_parent_dir.full_path, de.*, new_version.*)::dir_entry_full;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_update_handler
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: current_entry dir_entry_full, parent_entry_id bigint, name character varying, entry_type, INOUT size bigint, INOUT conflict boolean, OUT det dir_entry_type
Volatility: volatile
Language: sql
Source Code:

    WITH det AS (
        UPDATE dir_entry SET version_count = version_count + 1
            WHERE parent_entry_id = $2 AND hash(normalize(name)) = hash(normalize($3)) AND
                normalize(name) = normalize($3) AND entry_type = $4 RETURNING *
    ) SELECT $5 - $1.size, $6 OR $1.conflict, (det.*)::dir_entry_type FROM det;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_change_lookup
Schema: fs_func_v120
Result Data Type: SETOF file_change_result
Argument Data Types: start_version bigint, end_version bigint, maxrecords bigint, includensc boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT version_id, entry_full_path(d.parent_entry_id, d.name, d.full_path),
            CASE WHEN is_create AND (sync OR $4) THEN 'CREATE'::file_change_event ELSE 'DELETE'::file_change_event END,
            entry_type, NULL::VARCHAR, SIZE, hash, version_id, conflict, content_id, fs_id, move_target_version,
            mtime
        FROM dir_entry d, version v
        WHERE (latest = TRUE OR is_collapsed = FALSE) AND (is_create OR NOT version_hide)
            AND version_id &gt; $1 AND version_id &lt;= $2 AND d.entry_id = v.entry_id
        ORDER BY version_id
        LIMIT $3

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_close
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: prev_content_id bigint, recovered_version bigint, fs_recovered_version bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, size bigint, hash bytea, storage_id bigint, object_path character varying, client_id bigint, implicit_creates boolean, create_conflict boolean, from_link_upload boolean, is_anonymous boolean, args character varying, object_ctid tid
Volatility: volatile
Language: sql
Source Code:

    SELECT limit_file_size($7);
    SELECT dir_entry_full_to_result(v, $9, $10) FROM
        version_insert($1, $2, $3, $4, $5, 'FILE'::entry_type, FALSE, FALSE, $6, $11, $7, $8,
                NULL::INTEGER, NULL::BIGINT, $16, $17, $12, $13,
                CASE WHEN $3 IS NOT NULL THEN 'RECOVER'::version_event
                     WHEN $14 AND $15 THEN 'UPLOAD_LINK_ANON'::version_event
                     WHEN $14 THEN 'UPLOAD_LINK_PRIV'::version_event
                     WHEN $1 IS NULL THEN 'CREATE'::version_event
                     ELSE 'UPDATE'::version_event END, TRUE, $14, $15) v;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_entry_lookup
Schema: fs_func_v120
Result Data Type: record
Argument Data Types: parent character varying, name character varying, OUT parent_path character varying, OUT entry_id bigint, OUT parent_entry_id bigint, OUT name character varying, OUT entry_type entry_type, OUT full_path character varying, OUT version_count integer
Volatility: volatile
Language: sql
Source Code:

    SELECT p.full_path, d.*
        FROM directory_lookup_int($1, TRUE, FALSE) p, dir_entry d
        WHERE p.entry_id = d.parent_entry_id AND hash(normalize(name)) = hash(normalize($2))
             AND normalize(name) = normalize($2) AND entry_type = 'FILE'::entry_type;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_rename_as_conflict
Schema: fs_func_v120
Result Data Type: version
Argument Data Types: dir dir_lookup_result, current_entry dir_entry_full, conflict_name character varying, client_id bigint, event version_event
Volatility: volatile
Language: sql
Source Code:

    SELECT entry_delete($2, TRUE, $4, TRUE, NULL::BIGINT);
    SELECT version_copy($2, d.entry_id, TRUE, TRUE, $5, $4,
           array_to_args($2.name), $2.fs_id)
        FROM dir_entry_upsert($1.entry_id, $1.full_path, $3, $2.entry_type) d;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_restore
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: src_entry dir_entry_result, dest_parent character varying, dest_name character varying, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT file_restore_entry($1, p, $3, $4)
           FROM directory_lookup($2, TRUE, $4, FALSE, FALSE, 'RESTORE'::version_event) p

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_restore_entry
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: src_entry dir_entry_result, dest_parent_dir dir_lookup_result, dest_name character varying, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(res.def)
        FROM (
            SELECT er.result def,
                    filesystem_update_stats(fs_id(), file_count, size_change, dir_count,
                        conflict_count, (er.result).version_id),
                    directory_size_update($2.fs_id, $2.version_ctid, er.child_count)
                FROM entry_restore($1, $2, $3, $4, FALSE) er
        ) res;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_restore_latest
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT file_restore(src, $1, $2, $3)
           FROM file_restore_lookup_latest($1, $2, $3) src

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_restore_lookup_latest
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: parent character varying, name character varying, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result((p.full_path, d.*, v.*)::dir_entry_full)
        FROM directory_lookup($1, TRUE, $3, FALSE, FALSE, 'RESTORE'::version_event) p,
            dir_entry d, version v
        WHERE p.entry_id = d.parent_entry_id AND hash(normalize(name)) = hash(normalize($2))
             AND normalize(name) = normalize($2) AND entry_type = 'FILE'::entry_type
             AND v.entry_id = d.entry_id AND latest AND NOT is_create AND NOT pruned;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_total_used_space
Schema: fs_func_v120
Result Data Type: numeric
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT coalesce(sum(size), 0) FROM version WHERE is_create AND NOT pruned;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_id
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: 
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    fs_id BIGINT;
BEGIN
    EXECUTE $q$SELECT * FROM fs_id_int()$q$ INTO fs_id;
    RETURN fs_id;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_active_associated_edp
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: fs_id bigint, client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT * FROM filesystem fs WHERE fs.fs_id = $1 AND fs_is_edp(fs.type)
                      AND fs.owner_id = user_extract_id($2) AND fs.state = 'ACTIVE'
                      AND fs.client_id IS NOT NULL);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: gen_conflict_string
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: user_id bigint, loop integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ' ( ' || (user_lookup_or_fail($1)).name || $s$'s conflict $s$ || --' fix syntax
            to_char(statement_timestamp(), 'YYYY-MM-DD') ||
            CASE WHEN $2 = 0 THEN '' ELSE ' ' || $2  END || ' )';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: generate_unique_mountpoint_name
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: parent_path character varying, name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    i INTEGER := 1;
    parent_dir dir_lookup_result;
    entry dir_entry_full;
    unique_name VARCHAR;
BEGIN

    parent_dir := directory_lookup(parent_path, FALSE, FALSE);
    entry = entry_lookup(parent_dir, name, NULL::BIGINT);
    IF entry.entry_id IS NULL THEN
        RETURN name;
    END IF;

    LOOP
        unique_name := '' || name || ' (' || i || ')';
        entry := entry_lookup(parent_dir, unique_name, NULL::BIGINT);
        IF entry.entry_id IS NULL THEN
            RETURN unique_name;
        END IF;
        i := i + 1;
    END LOOP;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: generate_unique_mountpoint_name_if_necessary
Schema: fs_func_v120
Result Data Type: character varying
Argument Data Types: parent_path character varying, name character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $1 = '/' THEN $2 ELSE generate_unique_mountpoint_name('/', $2) END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: historic_mountpoint_versions_lookup_after
Schema: fs_func_v120
Result Data Type: SETOF version
Argument Data Types: possible_mountpoint character varying, after_timestamp timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT v.*
        FROM dir_entry d, version v
        WHERE hash(normalize(d.full_path)) = hash(normalize($1))
            AND normalize(d.full_path) = normalize($1) AND d.entry_type = 'DIRECTORY'
            AND d.entry_id = v.entry_id AND is_create AND fs_id IS NOT NULL
            AND (replaced IS NULL OR replaced &gt;= $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: historic_mountpoint_versions_lookup_before
Schema: fs_func_v120
Result Data Type: SETOF version
Argument Data Types: possible_mountpoint character varying, before_timestamp timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    SELECT v.*
        FROM dir_entry d, version v
        WHERE hash(normalize(d.full_path)) = hash(normalize($1))
            AND normalize(d.full_path) = normalize($1) AND d.entry_type = 'DIRECTORY'
            AND d.entry_id = v.entry_id AND is_create AND fs_id IS NOT NULL
            AND ($2 IS NULL OR timestamp &lt;= $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: insert_latest_version
Schema: fs_func_v120
Result Data Type: version
Argument Data Types: entry_id bigint, is_create boolean, pruned boolean, conflict boolean, activity_hide boolean, event version_event, mtime timestamp with time zone, client_id bigint, size bigint, hash bytea, children integer, fs_id bigint, args character varying, unused_replaced timestamp with time zone, is_collapsed boolean, move_target_version bigint, contentid bigint, sync boolean, version_hide boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE version SET latest = FALSE, replaced = statement_timestamp() WHERE entry_id = $1 AND latest = TRUE;
    UPDATE version SET is_collapsed = TRUE
        WHERE $15 = FALSE AND entry_id = $1 AND is_collapsed = FALSE AND move_target_version IS NULL;

    -- the daily/weekly/monthly flag is only set on a version (and cleared on previous versions)
    -- if it is a CREATE and it is NOT a hidden version
    UPDATE version SET is_daily = CASE WHEN timestamp &gt;= start_of_interval('days') THEN FALSE ELSE is_daily END,
            is_weekly = CASE WHEN timestamp &gt;= start_of_interval('weeks') THEN FALSE ELSE is_weekly END,
            is_monthly = FALSE
        WHERE $2 AND NOT $19 AND entry_id = $1 AND timestamp &gt;= start_of_interval('months')
            AND (is_daily = TRUE OR is_weekly = TRUE OR is_monthly = TRUE);

    INSERT INTO version (version_id, entry_id, latest, is_create, pruned, conflict,
            activity_hide, event, mtime, timestamp, tsextra, client_id, size,
            hash, children, fs_id, args, replaced, is_collapsed, move_target_version, content_id,
            sync, is_daily, is_weekly, is_monthly, version_hide)
        VALUES (version_id_next(), $1, TRUE, $2, $3, $4, $5, $6, $7, statement_timestamp(),
                tsextra_next(), $8, $9, $10, $11, $12, $13, NULL::TIMESTAMPTZ, $15, $16, $17, $18,
                $2 AND NOT $19, $2 AND NOT $19, $2 AND NOT $19, $19) RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mkdirs
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: path character varying, client_id bigint, event version_event
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    entries VARCHAR[];
    name VARCHAR;
    result dir_entry_full;
    parent VARCHAR := '/';
BEGIN
    entries := path_to_array(path);
    FOREACH name IN ARRAY entries LOOP
        SELECT *
            FROM version_insert(NULL::BIGINT, NULL::BIGINT, NULL::BIGINT, parent, name,
                'DIRECTORY'::entry_type, FALSE, TRUE, now(), client_id, NULL::BIGINT, NULL::BYTEA,
                0, NULL::BIGINT, NULL::VARCHAR, NULL::TID, FALSE, TRUE, event, TRUE, FALSE, FALSE)
            INTO result;
        parent := full_path(parent, name);
        RETURN NEXT result;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: optimize_space
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: table_num integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CASE table_num
        WHEN 0 THEN
            IF should_cluster('version', 1000000, 830) THEN
                PERFORM log_terse('clustering ' || fsid_to_schema(fs_id()) || '.version');
                CLUSTER version USING idx_version_version_id;
            END IF;
        WHEN 1 THEN
            IF should_cluster('version_read', 1000000, 260) THEN
                PERFORM log_terse('clustering ' || fsid_to_schema(fs_id()) || '.version_read');
                CREATE INDEX idx_version_read_cluster ON version_read(version_id);
                CLUSTER version_read USING idx_version_read_cluster;
                DROP INDEX IF EXISTS idx_version_read_cluster;
            END IF;
        WHEN 2 THEN
            IF should_cluster('dir_entry', 1000000, 430) THEN
                PERFORM log_terse('clustering ' || fsid_to_schema(fs_id()) || '.dir_entry');
                CLUSTER dir_entry USING idx_dir_entry_name;
            END IF;
    END CASE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: read_record
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: version_id bigint, client_id bigint, event version_event, args character varying
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO version_read (timestamp, tsextra, version_id, client_id, event, args)
        VALUES (now(), tsextra_next(), $1, $2, $3, $4);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: recovery_content_id
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: current_entry dir_entry_full, prev_content_id bigint, recovered_version bigint, fs_recovered_version bigint, size bigint, hash bytea
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF prev_content_id IS NULL THEN
        IF current_entry.content_id IS NULL THEN
            -- Doing a put leave it null
        ELSIF current_entry.size = size AND current_entry.hash = hash THEN
            prev_content_id := -1;
        ELSIF current_entry.version_id &lt; fs_recovered_version THEN
            -- Update without conflict because client is ahead of server
            prev_content_id := current_entry.content_id;
        ELSE
            -- Force conflict
            prev_content_id := -1;
        END IF;
    ELSE
        IF current_entry.content_id = prev_content_id THEN
            IF current_entry.version_id &gt; fs_recovered_version THEN
                -- Already been updated by somebody else
                prev_content_id := -1;
            END IF;
        ELSIF recovered_version &gt;= fs_recovered_version THEN
            IF current_entry.content_id IS NULL THEN
                -- Do a put
                prev_content_id := null;
            ELSIF current_entry.version_id &lt; fs_recovered_version THEN
                 -- Must have lost the version they wanted to update just let it update
                 prev_content_id := current_entry.content_id;
            END IF;
        END IF;
    END IF;
    RETURN prev_content_id;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: should_cluster
Schema: fs_func_v120
Result Data Type: boolean
Argument Data Types: tablename character varying, min_size bigint, min_row_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rowsize BIGINT;
    relsize BIGINT;
    rowcount BIGINT;
BEGIN
    EXECUTE $q$ SELECT pg_total_relation_size($1) $q$ USING quote_ident(tablename) INTO relsize;
    IF relsize &lt; min_size THEN
        RETURN FALSE;
    END IF;
    EXECUTE $q$ SELECT count(*) FROM $q$ || quote_ident(tablename) INTO rowcount;
    IF rowcount = 0 OR (relsize / rowcount) &lt; min_row_size THEN
        RETURN FALSE;
    END IF;
    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: start_of_interval
Schema: fs_func_v120
Result Data Type: timestamp with time zone
Argument Data Types: interval_unit text
Volatility: volatile
Language: sql
Source Code:

    SELECT date_trunc($1, now());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sync_directory
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(v) FROM
            sync_directory_int($1, $2, $3) v;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sync_directory_int
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    de dir_entry_full;
    new_version version_type;
    fs filesystem;
BEGIN
     EXECUTE $q$ SELECT * FROM directory_lookup_full($1, FALSE)$q$ USING fullpath INTO de;
     IF de.fs_id IS NULL THEN
        RAISE EXCEPTION 'DIRECTORY NOT SHARED';
     END IF;
     fs := filesystem_lookup_one(de.fs_id);
     IF fs_is_mobilized(fs.type) THEN
         PERFORM raise_mobilized_path((fs_id(), fullpath, de.parent_path, de.name,
            (fs.owner_id = userid), fs.shared_time, de.sync, fs.type, NULL, NULL, NULL, dir_entry_full_perms())::resolved_path);
     END IF;
     EXECUTE $q$ SELECT * FROM insert_latest_version($1, TRUE, FALSE, FALSE, FALSE, 'SYNC'::version_event, $2, $3, NULL::BIGINT, NULL::BYTEA, 0, $4,
            NULL::VARCHAR, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT, content_id_next(), TRUE, FALSE) $q$
         USING de.entry_id, de.mtime, clientid, de.fs_id INTO new_version;
     PERFORM filesystem_update_stats(fs_id(), 0, 0, 0, 0, new_version.version_id);
     RETURN QUERY SELECT de.parent_path, de.entry_id, de.parent_entry_id, de.name, de.entry_type, de.full_path, de.version_count, new_version.*;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: to_directory_lookup_result
Schema: fs_func_v120
Result Data Type: SETOF directory_lookup_result
Argument Data Types: dir_result dir_lookup_result
Volatility: volatile
Language: sql
Source Code:

     SELECT $1.entry_id, $1.full_path;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unsync_directory
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_result
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT dir_entry_full_to_result(v) FROM
            unsync_directory_int($1, $2, $3) v;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unsync_directory_int
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    de dir_entry_full;
    new_version version_type;
    fs filesystem;
BEGIN
     EXECUTE $q$ SELECT * FROM directory_lookup_full($1, FALSE)$q$ USING fullpath INTO de;
     IF de.fs_id IS NULL THEN
        RAISE EXCEPTION 'DIRECTORY NOT SHARED';
     END IF;
     fs := filesystem_lookup_one(de.fs_id);
     IF fs_is_mobilized(fs.type) THEN
         PERFORM raise_mobilized_path((fs_id(), fullpath, de.parent_path, de.name,
            (fs.owner_id = userid), fs.shared_time, de.sync, fs.type, NULL, NULL, NULL, dir_entry_full_perms())::resolved_path);
     END IF;
     EXECUTE $q$ SELECT * FROM insert_latest_version($1, TRUE, FALSE, FALSE, FALSE, 'UNSYNC'::version_event, $2, $3, NULL::BIGINT, NULL::BYTEA, 0, $4,
            NULL::VARCHAR, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT, content_id_next(), FALSE, FALSE) $q$
         USING de.entry_id, de.mtime, clientid, de.fs_id INTO new_version;
     PERFORM filesystem_update_stats(fs_id(), 0, 0, 0, 0, new_version.version_id);
     RETURN QUERY SELECT de.parent_path, de.entry_id, de.parent_entry_id, de.name, de.entry_type, de.full_path, de.version_count, new_version.*;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: update_latest_version
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: entryid bigint, fsid bigint, iscollapsed boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE version SET fs_id = $2, is_collapsed = $3 WHERE entry_id = $1 AND latest = TRUE;
    UPDATE version SET is_collapsed = TRUE
        WHERE $3 = FALSE AND entry_id = $1 AND is_collapsed = FALSE AND move_target_version IS NULL
        AND latest = FALSE;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_lookup_or_fail
Schema: fs_func_v120
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    ret_user user_account;
BEGIN
    ret_user := user_lookup(user_id);
    IF ret_user.user_id IS NULL THEN
        RAISE EXCEPTION 'User not found for id %', user_id;
    END IF;
    RETURN next ret_user;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_clear_extended_versions
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: daily_version_prune_time timestamp with time zone, weekly_version_prune_time timestamp with time zone, monthly_version_prune_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    UPDATE version SET is_daily = CASE WHEN replaced &lt; $1 THEN FALSE ELSE is_daily END,
        is_weekly = CASE WHEN replaced &lt; $2 THEN FALSE ELSE is_weekly END,
        is_monthly = CASE WHEN replaced &lt; $3 THEN FALSE ELSE is_monthly END
        WHERE (is_daily = TRUE OR is_weekly = TRUE OR is_monthly = TRUE)
          AND replaced IS NOT NULL AND replaced &lt; GREATEST($1, $2, $3);
    SELECT * FROM filesystem_update_extended_prune_values(fs_id(), $1, $2, $3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_copy
Schema: fs_func_v120
Result Data Type: version
Argument Data Types: src dir_entry_full, entry_id bigint, conflict boolean, hidden boolean, event version_event, client_id bigint, args character varying, shareid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT version_copy(r, $2, $3, $4, $5, $6, $7, $8, $1.children) FROM dir_entry_full_to_result($1) r;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_copy
Schema: fs_func_v120
Result Data Type: version
Argument Data Types: src dir_entry_result, entry_id bigint, conflict boolean, hidden boolean, event version_event, client_id bigint, args character varying, shareid bigint, children integer
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE WHEN $1.entry_type = 'FILE'::entry_type THEN
        object_refcount_update($1.size, $1.hash, 1)
    END;
    SELECT * FROM insert_latest_version($2, TRUE, FALSE, $3, $4, $5, $1.mtime, $6,
        $1.size, $1.hash, $9, $8, $7, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT,
        content_id_next(), $1.sync, FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_id_next
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('version_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_id_next
Schema: fs_func_v120
Result Data Type: bigint
Argument Data Types: fs_schema character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval($1 || '.version_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_insert
Schema: fs_func_v120
Result Data Type: SETOF dir_entry_full
Argument Data Types: prev_content_id bigint, recovered_version bigint, fs_recovered_version bigint, parent_path character varying, name character varying, entry_type entry_type, conflict boolean, activity_hide boolean, mtime timestamp with time zone, client_id bigint, size bigint, hash bytea, children integer, fs_id bigint, args character varying, object_ctid tid, mkdirs boolean, create_conflicts boolean, event version_event, sync boolean, from_link_upload boolean, is_anonymous boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    parent_dir dir_lookup_result;
    current_entry dir_entry_full;
    de dir_entry_type;
    new_version version_type;
    file_change BIGINT := 0;
    size_change BIGINT := 0;
    dir_change BIGINT := 0;
    conflict_change BIGINT := 0;
    is_edp_fs BOOLEAN;
    performing_client client;
BEGIN
    SELECT * FROM directory_lookup(parent_path, mkdirs, client_id, FALSE, FALSE, event)
        INTO parent_dir;
    IF parent_dir.fs_id IS NOT NULL THEN
        RAISE EXCEPTION 'INSERT BELOW MOUNTPOINT: %', parent_dir.full_path;
    END IF;
    IF name IS NULL OR char_length(name) &lt; 1 THEN
        RAISE EXCEPTION 'name must not be empty or null';
    END IF;
    EXECUTE $q$SELECT * FROM entry_lookup($1, $2, NULL)$q$ USING parent_dir, name INTO current_entry;

    IF fs_recovered_version IS NOT NULL THEN
        prev_content_id := recovery_content_id(current_entry, prev_content_id, recovered_version,
                fs_recovered_version, size, hash);
    END IF;

    IF current_entry.content_id IS NULL AND prev_content_id IS NULL THEN
        -- New create
        EXECUTE $q$SELECT directory_size_update($1, $2, 1)$q$ USING parent_dir.fs_id, parent_dir.version_ctid;
        SELECT * FROM dir_entry_upsert(parent_dir.entry_id, parent_dir.full_path, name, entry_type)
            INTO de;
        IF entry_type = 'DIRECTORY'::entry_type THEN
            dir_change := 1;
        ELSE
            file_change := 1;
            size_change := size;
        END IF;
    ELSIF current_entry.content_id = prev_content_id THEN
        -- Update existing create
        IF current_entry.entry_type &lt;&gt; entry_type THEN
            RAISE EXCEPTION 'TYPE COLLISION';
        END IF;
        IF entry_type = 'FILE' THEN
            EXECUTE $q$
                    SELECT size, conflict, (euh.det).*
                        FROM entry_update_handler($1, $2, $3, $4, $5, $6) euh
            $q$ USING current_entry, parent_dir.entry_id, name, entry_type, size, conflict
                INTO size_change, conflict, de.entry_id, de.parent_entry_id, de.name, de.entry_type,
                    de.full_path, de.version_count;
        END IF;
    ELSIF (entry_type = 'DIRECTORY'::entry_type AND current_entry.entry_type = entry_type)
        OR (entry_type = 'FILE'::entry_type AND current_entry.size = size
            AND current_entry.hash = hash) THEN
        -- If the directory already exists or the file is already at the same contents and we have an
        -- object to update just return the current entry.
        IF entry_type = 'FILE'::entry_type AND object_ctid IS NULL THEN
            PERFORM object_refcount_update(size, hash, -1);
        END IF;
        RETURN NEXT current_entry;
        RETURN;
    ELSE
        performing_client := client_lookup(client_id);
        IF performing_client.scope &lt;&gt; 'PUBLIC_API' AND current_entry.client_id = client_id 
                AND NOT current_entry.activity_hide AND current_entry.entry_type = entry_type 
                AND entry_type = 'FILE'::entry_type AND recovered_version IS NULL 
                AND NOT from_link_upload THEN
            EXECUTE $q$
                    SELECT size, conflict, (euh.det).*
                        FROM entry_update_handler($1, $2, $3, $4, $5, $6) euh
            $q$ USING current_entry, parent_dir.entry_id, name, entry_type, size, conflict
                INTO size_change, conflict, de.entry_id, de.parent_entry_id, de.name, de.entry_type,
                    de.full_path, de.version_count;
        ELSE
            -- Handle conflicts
            is_edp_fs := fs_is_active_associated_edp(fs_id(), client_id);
            IF create_conflicts OR is_edp_fs THEN
                IF entry_type = 'DIRECTORY'::entry_type THEN
                    -- if edp filesystem then we don't want conflicts just delete the old conflicting entry
                    IF is_edp_fs THEN
                        EXECUTE $q$ SELECT directory_entry_delete($1, $2, $3, FALSE, $4) $q$
                            USING parent_path, current_entry.name, current_entry.content_id, client_id;
                    ELSE
                        EXECUTE $q$SELECT file_rename_as_conflict($1, $2, $3, $4, 'CONFLICT'::version_event)$q$
                            USING parent_dir, current_entry,
                            create_conflict_name(parent_dir, current_entry.name, client_id), client_id;
                    END IF;
                    dir_change := 1;
                ELSE
                    IF is_edp_fs THEN
                        -- if edp filesystem and old entry is directory, delete the existing dir
                        IF current_entry.entry_type = 'DIRECTORY'::entry_type THEN
                            EXECUTE $q$ SELECT directory_entry_delete($1, $2, $3, TRUE, $4) $q$
                                USING parent_path, current_entry.name, current_entry.content_id, client_id;
                            file_change := 1;
                            size_change := size;
                        ELSE
                        -- if edp fs and current entry is file update stats - no delete necessary
                            file_change := 0;
                            size_change := size - current_entry.size;
                        END IF;
                    ELSE
                        IF from_link_upload AND is_anonymous THEN
                            event := 'CONFLICT_LINK_ANON'::version_event;
                        ELSIF from_link_upload THEN
                            event := 'CONFLICT_LINK_PRIV'::version_event;
                        ELSE
                            event := 'CONFLICT'::version_event;
                            args := array_to_args(name);
                        END IF;
                        SELECT create_conflict_name(parent_dir, name, client_id) INTO name;
                        conflict := TRUE;
                        file_change := 1;
                        size_change := size;
                    END IF;
                END IF;
                SELECT * FROM dir_entry_upsert(parent_dir.entry_id, parent_dir.full_path, name,
                        entry_type)
                    INTO de;
                IF is_edp_fs = FALSE THEN
                    conflict_change := 1;
                END IF;
            ELSIF current_entry.content_id IS NOT NULL THEN
                RAISE EXCEPTION 'DESTINATION EXISTS: %', full_path(parent_path, name);
            ELSE 
                RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(parent_path, name);
            END IF;
        END IF;
    END IF;

    PERFORM object_refcount_update(object_ctid, 1);
    EXECUTE $q$SELECT * FROM insert_latest_version($1, TRUE, FALSE, $2, $3, $4, $5, $6, $7, $8, $9, $10,
            $11, NULL::TIMESTAMPTZ, TRUE, NULL::BIGINT, content_id_next(), $12, FALSE)$q$
        USING de.entry_id, conflict, activity_hide, event, mtime, client_id, size, hash, children,
            fs_id, args, sync
        INTO new_version;
    PERFORM filesystem_update_stats(fs_id(), file_change, size_change, dir_change, conflict_change,
            new_version.version_id, CASE WHEN fs_recovered_version IS NULL THEN TRUE ELSE FALSE END);

    RETURN QUERY SELECT parent_dir.full_path, de.*, new_version.*;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_prune
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: prune_age_secs integer, max_versions integer, fs_age_prune boolean, fs_max_version_prune integer, daily_version_keep_days integer, weekly_version_keep_weeks integer, monthly_version_keep_months integer, fs_is_private boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT check_prune_indexes($1, $2, $3, $4);
    SELECT version_clear_extended_versions(
        now() - ($5 || 'days') :: INTERVAL,
        now() - ($6 || 'weeks') :: INTERVAL,
        now() - ($7 || 'months') :: INTERVAL);
    SELECT version_prune_time(now() - ($1 || 'seconds')::interval, $8);
    SELECT version_prune_count($2, $2 + $5 + $6 + $7);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_prune_count
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: latest_versions integer, total_versions integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    de RECORD;
    v RECORD;
    count INTEGER;
    prune_count INTEGER := 0;
BEGIN
    FOR de IN EXECUTE $q$SELECT entry_id, version_count, CTID FROM dir_entry
            WHERE version_count &gt; $1$q$ USING total_versions LOOP
        count := 0;
        FOR v IN EXECUTE
                $q$SELECT is_create, (is_daily OR is_weekly OR is_monthly) AS is_extended_version,
                          version_hide, CTID FROM version v
                    WHERE entry_id = $1 AND pruned = FALSE AND (latest = FALSE OR is_create = FALSE)
                    ORDER BY version_id DESC$q$
                USING de.entry_id LOOP
            IF count &lt; latest_versions THEN
                IF v.is_create AND NOT v.version_hide THEN
                    count := count + 1;
                END IF;
            ELSIF NOT v.is_extended_version THEN
                EXECUTE $q$UPDATE version v
                        SET pruned = decrement_ref_count(size, hash, $2), hash = NULL,
                            replaced = CASE WHEN replaced IS NULL THEN now() ELSE replaced END
                        WHERE CTID = $1$q$
                    USING v.CTID, v.is_create;
                IF v.is_create THEN
                    prune_count := prune_count + 1;
                END IF;
            END IF;
        END LOOP;
        EXECUTE $q$UPDATE dir_entry SET version_count = version_count - $2 WHERE CTID = $1$q$
            USING de.CTID, prune_count;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_prune_time
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: prune_time timestamp with time zone, fs_is_private boolean
Volatility: volatile
Language: sql
Source Code:

    WITH pruned(entry_id, is_create) AS (
        UPDATE version v
            SET pruned = decrement_ref_count(size, hash, is_create), hash = NULL,
                replaced = CASE WHEN replaced IS NULL THEN now() ELSE replaced END
            WHERE ((replaced IS NOT NULL AND replaced &lt;= $1) OR (NOT is_create AND timestamp &lt;= $1))
                AND pruned = FALSE AND is_daily = FALSE AND is_weekly = FALSE AND is_monthly = FALSE
                AND ($2 = FALSE OR fs_id IS NULL OR
                    EXISTS (SELECT 1 FROM filesystem f WHERE f.fs_id = v.fs_id AND f.state = 'DELETED'::filesystem_state))
            RETURNING entry_id, is_create
    ) SELECT decrement_version_count(p.entry_id, count(p.entry_id))
        FROM pruned p WHERE is_create GROUP BY p.entry_id;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_read_delete_version
Schema: fs_func_v120
Result Data Type: void
Argument Data Types: version_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM version_read r 
        WHERE r.version_id = $1 AND r.event = 'READ'::version_event;
    DELETE FROM version_read r 
        WHERE r.version_id = $1 AND r.event &lt;&gt; 'READ'::version_event;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_replaced_delete_before
Schema: fs_func_v120
Result Data Type: SETOF version
Argument Data Types: before_timestamp timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM version WHERE ctid IN (SELECT ctid FROM version v 
                                       WHERE replaced IS NOT NULL AND replaced &lt; $1 AND pruned = TRUE
                                       ORDER BY replaced)
        RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_archive_list
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, archive_age timestamp with time zone, last_fsid bigint, last_version_id bigint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mounted_fs mounted_filesystem_result;
BEGIN
    IF last_fsid IS NULL THEN
        last_fsid = 0;
    END IF;
    FOR mounted_fs IN SELECT * FROM sf_lookup_all_owned_filesystems(user_id, TRUE) LOOP
        CONTINUE WHEN mounted_fs.fs_id &lt; last_fsid;
        PERFORM set_path_read_fs(mounted_fs.fs_id);
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM
                (SELECT unresolve_path($1, $2, d) up FROM activity_archive_list($3, $4, $5) d) AS q
            $q$ USING mounted_fs.fs_id, mounted_fs.mounted_path, archive_age, 
                CASE WHEN mounted_fs.fs_id = last_fsid THEN last_version_id ELSE 0 END, max;
        EXIT WHEN FOUND;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', after_timestamp, after_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, aftertsextra smallint, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
    rmp resolved_historic_mountpoint;
    last_mp_replaced TIMESTAMPTZ := after_timestamp;
    found_cnt INTEGER;
BEGIN
    -- look up all historic mountpoints in the private filesystem fs_id that affected the
    -- specified path after the specified timestamp.
    PERFORM set_path_read_fs(fs_id);
    FOR rmp IN
        EXECUTE $q$ SELECT * FROM accessible_historic_mountpoints_lookup_after($1, $2) $q$
        USING full_path(parent, name), after_timestamp
    LOOP
        IF rmp.mountpoint_timestamp &gt; last_mp_replaced THEN
            -- for periods when there was no mountpoint, get info from the private filesystem
            PERFORM set_path_read_fs(fs_id);
            RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                        FROM activity_modify_list_after($3, $4, $5, $6, $7, $8, $9, FALSE, $10) d) AS q
                $q$
                USING fs_id, '/', parent, name, after_timestamp, afterTsextra,
                    last_mp_replaced, -- &quot;joined&quot; private FS at time left last mountpoint
                    rmp.mountpoint_timestamp, -- &quot;left&quot; private FS at time joined next mountpoint
                    pruned, max;
            GET DIAGNOSTICS found_cnt = ROW_COUNT;
            max := max - found_cnt;
            IF max &lt;= 0 THEN
                EXIT;  -- exit loop
            END IF;
        END IF;

        -- now get info from the mounted filesystem while it was mounted
        PERFORM set_path_read_fs(rmp.fs_id);
        RETURN QUERY EXECUTE $q$
                SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                    FROM activity_modify_list_after($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
            $q$
            USING rmp.fs_id, rmp.mountpoint_path,
                rmp.parent, rmp.name, after_timestamp, afterTsextra,
                rmp.mountpoint_timestamp, rmp.mountpoint_replaced, pruned,
                rmp.mountpoint_event &lt;&gt; 'SHARE'::version_event, max;
        GET DIAGNOSTICS found_cnt = ROW_COUNT;
        max := max - found_cnt;
        IF max &lt;= 0 THEN
            EXIT;  -- exit loop
        END IF;

        last_mp_replaced = rmp.mountpoint_replaced;

    END LOOP;

    IF max &gt; 0 AND last_mp_replaced IS NOT NULL THEN
        -- Finally, path is not currently mounted, so get any remaining results from the private FS
        PERFORM set_path_read_fs(fs_id);
        RETURN QUERY EXECUTE $q$
                SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                    FROM activity_modify_list_after($3, $4, $5, $6, $7, $8, $9, FALSE, $10) d) AS q
            $q$
            USING fs_id, '/', parent, name, after_timestamp, afterTsextra,
                  last_mp_replaced, -- &quot;joined&quot; private FS at time left last mountpoint
                  NULL::TIMESTAMPTZ, -- never &quot;left&quot; private FS
                  pruned, max;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', before_timestamp, before_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY SELECT * FROM activity_modify_list_before(fs_id, before_timestamp, before_tsextra, earliest_timestamp, max);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    result dir_entry_result;
    rmp resolved_historic_mountpoint;
    last_mp_timestamp TIMESTAMPTZ := before_timestamp;
    found_cnt INTEGER;
BEGIN
    -- look up all historic mountpoints in the private filesystem fs_id that affected the
    -- specified path before the specified timestamp.
    fs := set_path_read_fs(fs_id);
    FOR rmp IN
        EXECUTE $q$ SELECT * FROM accessible_historic_mountpoints_lookup_before($1, $2) $q$
        USING full_path(parent, name), before_timestamp
    LOOP
        IF rmp.mountpoint_replaced IS NOT NULL AND rmp.mountpoint_replaced &lt; last_mp_timestamp THEN
            -- for periods when there was no mountpoint, get info from the private filesystem
            PERFORM set_path_read_fs(fs_id);
            IF earliest_timestamp IS NULL THEN
                RETURN QUERY EXECUTE $q$
                        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                            FROM activity_modify_list_before($3, $4, $5, $6, $7, $8, $9, FALSE, $10) d) AS q
                    $q$
                    USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
                        rmp.mountpoint_replaced, -- &quot;joined&quot; private fs when left the next mountpoint
                        last_mp_timestamp,       -- &quot;left&quot; private fs when joined the last mountpoint
                        pruned, max;
            ELSE
                RETURN QUERY EXECUTE $q$
                        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                            FROM activity_audit_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q
                    $q$
                    USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
                        GREATEST(rmp.mountpoint_replaced, earliest_timestamp),
                        last_mp_timestamp,       -- &quot;left&quot; private fs when joined the last mountpoint
                        pruned, max;
            END IF;
            GET DIAGNOSTICS found_cnt = ROW_COUNT;
            max := max - found_cnt;
            IF max &lt;= 0 THEN
                EXIT;  -- exit loop
            END IF;
        END IF;

        -- now get info from the mounted filesystem while it was mounted
        PERFORM set_path_read_fs(rmp.fs_id);
        IF earliest_timestamp IS NULL THEN
            RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                        FROM activity_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
                $q$
            USING rmp.fs_id, rmp.mountpoint_path,
                  rmp.parent, rmp.name, before_timestamp, before_tsextra,
                  rmp.mountpoint_timestamp, rmp.mountpoint_replaced, pruned,
                  rmp.mountpoint_event &lt;&gt; 'SHARE'::version_event, max;
        ELSE
            RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                        FROM activity_audit_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q
                $q$
            USING rmp.fs_id, rmp.mountpoint_path,
                  rmp.parent, rmp.name, before_timestamp, before_tsextra,
                  GREATEST(rmp.mountpoint_timestamp, earliest_timestamp),
                  rmp.mountpoint_replaced, pruned, max;
        END IF;
        GET DIAGNOSTICS found_cnt = ROW_COUNT;
        max := max - found_cnt;
        IF max &lt;= 0 THEN
            EXIT;  -- exit loop
        END IF;

        last_mp_timestamp = rmp.mountpoint_timestamp;

    END LOOP;

    IF max &gt; 0 THEN
        -- Finally, get any remaining results from the private FS
        PERFORM set_path_read_fs(fs_id);
        IF earliest_timestamp IS NULL THEN
            RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                        FROM activity_modify_list_before($3, $4, $5, $6, $7, $8, $9, FALSE, $10) d) AS q
                $q$
                USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
                      NULL::TIMESTAMPTZ, last_mp_timestamp, pruned, max;
        ELSE
            RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                        FROM activity_audit_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q
                $q$
                USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
                      earliest_timestamp, last_mp_timestamp, pruned, max;
        END IF;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, pruned boolean, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM activity_modify_list_before($1, $2, $3, $4, $5, NULL::TIMESTAMPTZ, $6, $7);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_modify_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING sf_id, mountpoint_path, after_timestamp, after_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING sf_id, mountpoint_path, before_timestamp, before_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_read_link_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING sf_id, mountpoint_path, after_timestamp, after_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING sf_id, mountpoint_path, before_timestamp, before_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_read_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, mountpoint_path, after_timestamp, after_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_preshare_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: user_id bigint, sf_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    mountpoint_path VARCHAR;
BEGIN
    mountpoint_path := resolve_mounted_path(user_id, sf_id);
    fs := set_path_read_fs(sf_id);
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, mountpoint_path, before_timestamp, before_tsextra, NULL::TIMESTAMPTZ, fs.shared_time, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', after_timestamp, after_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT *
        FROM activity_read_list_after_unsorted($1, $2, $3, $4, $5, $6, 'activity_read_link_list_after')
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', before_timestamp, before_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY SELECT * FROM activity_read_link_list_before(fs_id, before_timestamp, before_tsextra, earliest_timestamp, max);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT *
        FROM activity_read_list_before_unsorted($1, $2, $3, $4, $5, NULL::TIMESTAMPTZ, $6, 'activity_read_link_list_before')
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_after($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', after_timestamp, after_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT *
        FROM activity_read_list_after_unsorted($1, $2, $3, $4, $5, $6, 'activity_read_list_after')
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_after_unsorted
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, aftertsextra smallint, max integer, fs_func character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
    rmp resolved_historic_mountpoint;
    last_mp_replaced TIMESTAMPTZ := after_timestamp;
BEGIN
    -- look up all historic mountpoints in the private filesystem fs_id that affected the
    -- specified path after the specified timestamp.
    PERFORM set_path_read_fs(fs_id);
    FOR rmp IN
        EXECUTE $q$ SELECT * FROM accessible_historic_mountpoints_lookup_after($1, $2) $q$
        USING full_path(parent, name), after_timestamp
    LOOP
        IF rmp.mountpoint_timestamp &gt; last_mp_replaced THEN
            -- for periods when there was no mountpoint, get info from the private filesystem
            PERFORM set_path_read_fs(fs_id);
            RETURN QUERY EXECUTE $q$
                    SELECT * FROM $q$ || fs_func || $q$($1, $2, $3, $4, $5, $6, $7)
                $q$
                USING parent, name, after_timestamp, afterTsextra,
                    last_mp_replaced, -- &quot;joined&quot; private FS at time left last mountpoint
                    rmp.mountpoint_timestamp, -- &quot;left&quot; private FS at time joined next mountpoint
                    max;
        END IF;

        -- now get info from the mounted filesystem while it was mounted
        PERFORM set_path_read_fs(rmp.fs_id);
        RETURN QUERY EXECUTE $q$
                SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                    FROM $q$ || fs_func || $q$($3, $4, $5, $6, $7, $8, $9) d) AS q
            $q$
            USING rmp.fs_id, rmp.mountpoint_path,
                rmp.parent, rmp.name, after_timestamp, afterTsextra,
                rmp.mountpoint_timestamp, rmp.mountpoint_replaced, max;

        last_mp_replaced = rmp.mountpoint_replaced;

    END LOOP;

    IF last_mp_replaced IS NOT NULL THEN
        -- Finally, path is not currently mounted, so get any remaining results from the private FS
        PERFORM set_path_read_fs(fs_id);
        RETURN QUERY EXECUTE $q$
                SELECT * FROM $q$ || fs_func || $q$($1, $2, $3, $4, $5, $6, $7)
            $q$
            USING parent, name, after_timestamp, afterTsextra,
                  last_mp_replaced, -- &quot;joined&quot; private FS at time left last mountpoint
                  NULL::TIMESTAMPTZ, -- never &quot;left&quot; private FS
                  max;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY EXECUTE $q$SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_before($3, $4, $5, $6, $7) d) AS q$q$
        USING fs_id, '/', before_timestamp, before_tsextra, earliest_timestamp, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    earliest_timestamp TIMESTAMPTZ;
BEGIN
    SELECT calc_earliest_time(f) FROM set_path_read_fs(fs_id) f INTO earliest_timestamp;
    RETURN QUERY SELECT * FROM activity_read_list_before(fs_id, before_timestamp, before_tsextra, earliest_timestamp, max);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT *
        FROM activity_read_list_before_unsorted($1, $2, $3, $4, $5, NULL::TIMESTAMPTZ, $6, 'activity_read_list_before')
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_read_list_before_unsorted
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer, fs_func character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    result dir_entry_result;
    rmp resolved_historic_mountpoint;
    last_mp_timestamp TIMESTAMPTZ := before_timestamp;
BEGIN
    -- look up all historic mountpoints in the private filesystem fs_id that affected the
    -- specified path before the specified timestamp.
    fs := set_path_read_fs(fs_id);
    FOR rmp IN
        EXECUTE $q$ SELECT * FROM accessible_historic_mountpoints_lookup_before($1, $2) $q$
        USING full_path(parent, name), before_timestamp
    LOOP
        IF rmp.mountpoint_replaced IS NOT NULL AND rmp.mountpoint_replaced &lt; last_mp_timestamp THEN
            -- for periods when there was no mountpoint, get info from the private filesystem
            PERFORM set_path_read_fs(fs_id);
            RETURN QUERY EXECUTE $q$
                    SELECT * FROM $q$ || fs_func || $q$($1, $2, $3, $4, $5, $6, $7, $8)
                $q$
                USING parent, name, before_timestamp, before_tsextra,
                    rmp.mountpoint_replaced, -- &quot;joined&quot; private fs when left the next mountpoint
                    last_mp_timestamp,       -- &quot;left&quot; private fs when joined the last mountpoint
                    earliest_timestamp, max;
        END IF;

        -- now get info from the mounted filesystem while it was mounted
        PERFORM set_path_read_fs(rmp.fs_id);
        RETURN QUERY EXECUTE $q$
                SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                    FROM $q$ || fs_func || $q$($3, $4, $5, $6, $7, $8, $9, $10) d) AS q
            $q$
            USING rmp.fs_id, rmp.mountpoint_path,
                rmp.parent, rmp.name, before_timestamp, before_tsextra,
                rmp.mountpoint_timestamp, rmp.mountpoint_replaced, earliest_timestamp, max;

        last_mp_timestamp = rmp.mountpoint_timestamp;

    END LOOP;

    -- Finally, get any remaining results from the private FS
    PERFORM set_path_read_fs(fs_id);
    RETURN QUERY EXECUTE $q$
            SELECT * FROM $q$ || fs_func || $q$($1, $2, $3, $4, $5, $6, $7, $8)
        $q$
        USING parent, name, before_timestamp, before_tsextra,
              NULL::TIMESTAMPTZ, last_mp_timestamp, earliest_timestamp, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_modify_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, deleted boolean, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_after($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            after_timestamp, after_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, pruned, TRUE, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, deleted boolean, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            before_timestamp, before_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, pruned, TRUE, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_read_link_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, deleted boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_after($3, $4, $5, $6, $7, $8, $9) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            after_timestamp, after_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, deleted boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            before_timestamp, before_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_read_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, deleted boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_after($3, $4, $5, $6, $7, $8, $9) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            after_timestamp, after_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_resolve_sf_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, deleted boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), FALSE, FALSE, deleted);
    PERFORM assert_not_private_fs(resolved_path.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q$q$
        USING resolved_path.fs_id, '/', resolved_path.parent, resolved_path.name,
            before_timestamp, before_tsextra, resolved_path.shared_time, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_modify_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_after($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q$q$
        USING fs_id, '/', parent, name, after_timestamp, after_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, pruned, TRUE, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_modify_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, pruned boolean, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_modify_list_before($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q$q$
        USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, pruned, TRUE, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_read_link_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_after($3, $4, $5, $6, $7, $8, $9) d) AS q$q$
        USING fs_id, '/', parent, name, after_timestamp, after_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_read_link_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_link_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q$q$
        USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_read_list_after
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, after_timestamp timestamp with time zone, after_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_after($3, $4, $5, $6, $7, $8, $9) d) AS q$q$
        USING fs_id, '/', parent, name, after_timestamp, after_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: activity_sf_read_list_before
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := set_path_read_fs(fs_id);
    PERFORM assert_not_private_fs(fs.type);
    RETURN QUERY EXECUTE $q$ SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
        FROM activity_read_list_before($3, $4, $5, $6, $7, $8, $9, $10) d) AS q$q$
        USING fs_id, '/', parent, name, before_timestamp, before_tsextra,
              fs.shared_time, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: add_tenant_use
Schema: pod
Result Data Type: void
Argument Data Types: ten_id bigint, namespace_owner namespace_owner
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CASE namespace_owner
        WHEN 'SYSTEM'::namespace_owner THEN
            UPDATE tenant SET has_system_ns = TRUE, xid = xid_next(ten_id) WHERE tenant_id = ten_id AND has_system_ns = FALSE;
        WHEN 'MOBILE'::namespace_owner THEN
            UPDATE tenant SET has_mobile_ns = TRUE, xid = xid_next(ten_id) WHERE tenant_id = ten_id AND has_mobile_ns = FALSE;
        WHEN 'REMOTE'::namespace_owner THEN
            UPDATE tenant SET has_remote_ns = TRUE, xid = xid_next(ten_id) WHERE tenant_id = ten_id AND has_remote_ns = FALSE;
    END CASE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: additional_extended_upgrade_work
Schema: pod
Result Data Type: void
Argument Data Types: fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM extended_upgrade_phase2_work(fs);
    EXECUTE 'UPDATE extended_upgrade_states SET complete = TRUE WHERE fs_id = ' || fs.fs_id;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: apply_directory_entry_filter
Schema: pod
Result Data Type: boolean
Argument Data Types: filter directory_entry_filter, syncing boolean
Volatility: immutable
Language: sql
Source Code:

    SELECT ($1 = 'ALL_ENTRIES'::directory_entry_filter) 
        OR ($1 = 'AW_ONLY'::directory_entry_filter)
        OR ($1 = 'SYNCING_ONLY'::directory_entry_filter AND $2)
        OR ($1 = 'LINK'::directory_entry_filter);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: archive_delete_before
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint, archive_age timestamp with time zone, archive_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    owned_fs filesystem;
    mounted_fs mounted_filesystem_result;
BEGIN
    FOR owned_fs IN SELECT * FROM filesystem_owned_list(user_id) LOOP
        IF owned_fs.type in ('PRIVATE', 'SHARED', 'EDP') THEN
            PERFORM set_path_wlock_fs(owned_fs.fs_id);
            EXECUTE $q$ SELECT * FROM archive_delete_before($1) $q$ USING archive_age;
            -- drop filesystem, mark it deleted - if it's inactive and empty
            PERFORM archive_empty_filesystem(owned_fs.fs_id);
        END IF;
    END LOOP;

    PERFORM user_update_archive(user_id, archive_age, archive_size);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: array_len
Schema: pod
Result Data Type: integer
Argument Data Types: arr character varying[]
Volatility: immutable
Language: sql
Source Code:

    SELECT coalesce(array_length($1, 1), 0);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: array_to_args
Schema: pod
Result Data Type: character varying
Argument Data Types: VARIADIC args character varying[]
Volatility: immutable
Language: plpgsql
Source Code:

DECLARE
    result VARCHAR := '[';
    arg VARCHAR;
    first BOOLEAN := TRUE;
BEGIN
    FOREACH arg IN ARRAY args LOOP
        IF first THEN
            first := FALSE;
        ELSE
            result := result || ', ';
        END IF;
        result := result || '&quot;' || arg || '&quot;';
    END LOOP;
    result := result || ']';
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: array_to_path
Schema: pod
Result Data Type: character varying
Argument Data Types: entries character varying[], OUT path character varying
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    path := '/' || array_to_string(entries, '/');
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: array_to_resolved_path
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fsid bigint, anarray character varying[], mountpoint_path character varying, mountpoint_length integer, is_owner boolean, shared_time timestamp with time zone, sync boolean, fs_type filesystem_type, mount_time timestamp with time zone, unmount_time timestamp with time zone, role shared_folder_membership_role, permissions dir_entry_permission[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    length INT;
    resolved_length INT;
    resolved_parent VARCHAR;
    resolved_name VARCHAR;
    result resolved_path;
BEGIN
    length := array_length(anarray, 1);
    -- first generate the prefix string and the remainder of the array
    IF mountpoint_length = 0 THEN
        mountpoint_path := '/';
    ELSE
        IF mountpoint_length &lt; length THEN
            anarray := anarray[mountpoint_length + 1 : length];
            length := array_length(anarray, 1);
        ELSE
            anarray := '{}'; -- empty array
            length := 0;
        END IF;
    END IF;

    IF length = 0 THEN
        resolved_parent := NULL::VARCHAR;
        resolved_name := '';
    ELSIF length = 1 THEN
        resolved_parent := '/';
        resolved_name := anarray[1];
    ELSE
        resolved_parent := array_to_path(anarray[1 : length - 1]);
        resolved_name := anarray[length];
    END IF;

    result := (fsid, mountpoint_path, resolved_parent, resolved_name, is_owner, shared_time, sync,
               fs_type, mount_time, unmount_time, role, permissions)::resolved_path;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: assert_not_private_fs
Schema: pod
Result Data Type: void
Argument Data Types: fs_type filesystem_type
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    IF fs_type = 'PRIVATE'::filesystem_type THEN
        RAISE EXCEPTION 'DIRECTORY NOT SHARED';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: assert_under_limit
Schema: pod
Result Data Type: boolean
Argument Data Types: val numeric, limit_value numeric, error character varying, msg character varying DEFAULT NULL::character varying
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    IF val &gt; limit_value THEN
       IF msg IS NULL THEN
           msg := limit_value::VARCHAR;
       END IF;
       RAISE EXCEPTION '% : %', error, msg;
    END IF;
    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: assert_under_quota
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id_in bigint, size bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    has_exceeded BOOLEAN;
    fs filesystem;
BEGIN
    SELECT * FROM filesystem WHERE fs_id = fs_id_in INTO fs;
    IF fs.type = 'TEAM'::filesystem_type THEN
        SELECT has_exceeded_team_folder_quota(fs_id_in, fs.sum_file_size + size) INTO has_exceeded;
    ELSE
        SELECT has_exceeded_user_quota(owner, used + size) FROM 
            (SELECT filesystem_space_used_by((fs).owner_id, FALSE) AS used, (fs).owner_id AS owner) AS used
            INTO has_exceeded;
    END IF;
    IF has_exceeded THEN
        RAISE EXCEPTION 'QUOTA EXCEEDED : %', fs_id_in;
    END IF;
    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_modify_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM set_path_read_fs($1);
    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_modify_list_before($1, $2, $3, $4, $5) a,
           user_account u, client c
      WHERE a.client_id = c.client_id AND c.user_id = u.user_id
        AND ($6 IS NULL OR c.user_id = $6)
        AND NOT is_link_event(a.event);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_modify_path_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, pruned boolean, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_modify_list_before($1, $2, $3, $4, $5, $6, $7, $8) a,
           user_account u, client c
      WHERE a.client_id = c.client_id AND c.user_id = u.user_id;


Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_read_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM set_path_read_fs($1);
    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_read_list_before($1, $2, $3, $4, $5) a,
           user_account u, client c
      WHERE a.client_id = c.client_id AND c.user_id = u.user_id
        AND ($6 IS NULL OR c.user_id = $6);


Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_read_link_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM set_path_read_fs($1);
    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_read_link_list_before($1, $2, $3, $4, $5) a
           LEFT OUTER JOIN client c ON (a.client_id = c.client_id)
           LEFT OUTER JOIN user_account u ON (c.user_id = u.user_id);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_read_link_by_user_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM set_path_read_fs($1);
    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_read_link_list_before($1, $2, $3, $4, $5) a,
           client c, user_account u
      WHERE a.client_id = c.client_id AND c.user_id = $6 AND c.user_id = u.user_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_read_link_path_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
      FROM activity_read_list_before_unsorted($1, $2, $3, $4, $5, $6, $7, 'activity_read_link_list_before') a
           LEFT OUTER JOIN client c ON (a.client_id = c.client_id)
           LEFT OUTER JOIN user_account u ON (c.user_id = u.user_id)
      ORDER BY a.timestamp DESC, a.tsextra DESC
      LIMIT $7;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: audit_read_path_before
Schema: pod
Result Data Type: SETOF dir_entry_extended_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, before_timestamp timestamp with time zone, before_tsextra smallint, earliest_timestamp timestamp with time zone, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT a.*, u.name, u.display_name, u.email, c.name, c.operating_system, c.version
        FROM activity_read_list_before_unsorted($1, $2, $3, $4, $5, $6, $7, 'activity_read_list_before') a,
           user_account u, client c
        WHERE a.client_id = c.client_id AND c.user_id = u.user_id
        ORDER BY a.timestamp DESC, a.tsextra DESC
        LIMIT $7;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_create
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: name character varying, enabled boolean, type auth_provider_type, configuration character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result auth_provider;
BEGIN
    INSERT INTO auth_provider(auth_provider_id, name, enabled, type, configuration, priority, xid, state)
        VALUES (auth_provider_next_id(), $1, $2, $3, $4, auth_provider_next_priority(), 1, 'ACTIVE'::auth_provider_state)
        RETURNING * INTO result;
    PERFORM pgq.insert_event('resource_xid', result.auth_provider_id::TEXT, result.xid::TEXT);
    PERFORM auth_provider_name_check(name);
    RETURN NEXT result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_delete
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: auth_provider_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    cur_user_id BIGINT;
    result auth_provider;
BEGIN
    UPDATE auth_provider AS ap
        SET (state, xid) = ('DELETED'::auth_provider_state, ap.xid + 1)
        WHERE ap.auth_provider_id = $1 AND state = 'ACTIVE'::auth_provider_state
        RETURNING * INTO result;
    FOR cur_user_id IN SELECT user_id FROM user_account WHERE user_account.auth_provider_id = $1 AND state = 'ENABLED' LOOP
        PERFORM client_disable_all(cur_user_id, TRUE);
    END LOOP;

    IF result.auth_provider_id IS NOT NULL THEN
        PERFORM pgq.insert_event('resource_xid', $1::TEXT, result.xid::TEXT);
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_list
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM auth_provider WHERE state != 'DELETED'::auth_provider_state 
        ORDER BY priority;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_list
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: type auth_provider_type
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM auth_provider as ap WHERE ap.type = $1 AND state != 'DELETED'::auth_provider_state
        ORDER BY priority;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_list_enabled
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM auth_provider WHERE state != 'DELETED'::auth_provider_state
        AND enabled = TRUE ORDER BY priority;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_lookup
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: auth_provider_id bigint, include_deleted boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM auth_provider WHERE auth_provider_id = $1 AND ($2 OR state != 'DELETED'::auth_provider_state);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_lookup
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: name character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM auth_provider WHERE name = $1 AND state != 'DELETED'::auth_provider_state;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_name_check
Schema: pod
Result Data Type: void
Argument Data Types: name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BIGINT;
BEGIN
    SELECT COUNT(*) FROM auth_provider_lookup(name) INTO result;
    IF result &gt; 1 THEN
        RAISE EXCEPTION 'AUTH PROVIDER DUPLICATE NAME';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('auth_provider_id_seq') | resource_type_auth_provider();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_next_priority
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('auth_provider_priority_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_prioritize
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: in_auth_provider_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_default auth_provider;
    old_default auth_provider;
BEGIN
	SELECT * FROM auth_provider WHERE auth_provider_id = $1 INTO new_default;
	IF new_default.priority != 1 THEN
	-- Swap the priority value of the two entries
	    UPDATE auth_provider AS ap
	        SET (priority, xid) = (new_default.priority, ap.xid + 1)
	        WHERE ap.priority = 1
	        RETURNING * INTO old_default;
	    UPDATE auth_provider
	        SET (priority, xid) = (1, new_default.xid + 1)
	        WHERE auth_provider_id = new_default.auth_provider_id
	        RETURNING * INTO new_default;
	    PERFORM pgq.insert_event('resource_xid', old_default.auth_provider_id::TEXT, old_default.xid::TEXT);
	    PERFORM pgq.insert_event('resource_xid', new_default.auth_provider_id::TEXT, new_default.xid::TEXT);
	END IF;
	RETURN NEXT new_default;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: auth_provider_update
Schema: pod
Result Data Type: SETOF auth_provider
Argument Data Types: auth_provider_id bigint, name character varying, enabled boolean, configuration character varying, xid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, ($5 + 1)::TEXT);
    RETURN QUERY UPDATE auth_provider AS ap
        SET (name, enabled, configuration, xid) = ($2, $3, $4, $5 + 1)
        WHERE ap.auth_provider_id = $1 AND ap.xid = $5 AND ap.state = 'ACTIVE'::auth_provider_state
        RETURNING *;
    PERFORM auth_provider_name_check(name);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: aw_is_in_backup
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    stat record;
BEGIN
    BEGIN
        SELECT * FROM pg_stat_file('backup_label') INTO stat;
        RETURN stat.modification IS NOT NULL;
    EXCEPTION WHEN undefined_file THEN 
        RETURN FALSE;
    END;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: aw_start_backup
Schema: pod
Result Data Type: text
Argument Data Types: label text
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_label_config pod_config;
    startup_text text;
BEGIN
    current_label_config := pod_config_lookup('database.backup.label');
    IF aw_is_in_backup() AND current_label_config.value = 'startup_rsync' THEN
        PERFORM pg_stop_backup();
        
    END IF;
    startup_text := pg_start_backup(label);
    PERFORM pod_config_update('database.backup.label', 'startup_rsync', TRUE, NULL);
    RETURN startup_text;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: aw_stop_backup
Schema: pod
Result Data Type: text
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    current_label_config pod_config;
    stop_text text;
BEGIN
    current_label_config := pod_config_lookup('database.backup.label');
    IF aw_is_in_backup() AND current_label_config.value = 'startup_rsync' THEN
        stop_text := pg_stop_backup();
        PERFORM pod_config_update('database.backup.label', '', TRUE, NULL);
        RETURN stop_text;
    ELSE
        RAISE EXCEPTION 'no backup initiated by aw startup';
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: calc_earliest_time
Schema: pod
Result Data Type: timestamp with time zone
Argument Data Types: fs filesystem
Volatility: immutable
Language: sql
Source Code:

     SELECT CASE
         WHEN $1.type = 'PRIVATE'::filesystem_type
             OR ($1.cray_time IS NOT NULL AND $1.cray_time = $1.shared_time) THEN NULL::TIMESTAMPTZ
         ELSE $1.shared_time END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: can_hdi_namespace_user_be_reclaimed
Schema: pod
Result Data Type: boolean
Argument Data Types: tenant_id bigint, username character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT
      NOT EXISTS(SELECT 1 FROM namespace ns1 WHERE ns1.tenant_id=$1 and 
          ns1.username=$2 and NOT ns1.is_orphaned LIMIT 1)
          AND 
      NOT EXISTS(SELECT 1 FROM namespace ns2 WHERE ns2.tenant_id=$1 and
          ns2.read_only_username=$2 and NOT ns2.is_orphaned LIMIT 1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: check_can_write
Schema: pod
Result Data Type: void
Argument Data Types: clientid bigint, resolved_path resolved_path
Volatility: stable
Language: sql
Source Code:

    SELECT check_permissions(resolve_permissions($1, $2, NULL::dir_entry_result), dir_entry_wo_perms());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_can_write
Schema: pod
Result Data Type: void
Argument Data Types: curr_entry dir_entry_result
Volatility: immutable
Language: sql
Source Code:

    SELECT check_permissions($1, dir_entry_wo_perms());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_last_manager
Schema: pod
Result Data Type: boolean
Argument Data Types: fsid bigint, already_removed boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF is_last_manager(fsid, already_removed) THEN
        RAISE EXCEPTION 'REMOVE LAST MANAGER';
    END IF;
    RETURN FALSE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_last_member_or_invited
Schema: pod
Result Data Type: boolean
Argument Data Types: fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    member_count INTEGER;
BEGIN
    IF fs.type = 'TEAM'::filesystem_type AND fs.invited_count = 0 AND fs.joined_count = 0 THEN
        PERFORM tf_set_abandoned(fs.fs_id);
        RETURN TRUE;
    END IF;
    RETURN FALSE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_permissions
Schema: pod
Result Data Type: void
Argument Data Types: curr_entry dir_entry_result, required_permissions dir_entry_permission[]
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    PERFORM check_permissions($1.permissions, $2);
END 
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: check_permissions
Schema: pod
Result Data Type: void
Argument Data Types: curr_permissions dir_entry_permission[], required_permissions dir_entry_permission[]
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    IF NOT curr_permissions @&gt; required_permissions THEN 
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: clear_all_fs_upgrade_attempt_counts
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET upgrade_attempts = NULL;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_connected_counts
Schema: pod
Result Data Type: record
Argument Data Types: limit_seconds integer, OUT client_count bigint, OUT user_count bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT count(*), count(DISTINCT(user_id)) FROM client
            WHERE last_access + ($1 || ' seconds')::interval &gt;= transaction_timestamp()
        AND state = 'ACTIVE';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_create
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, owner_id bigint, name character varying, os character varying, version character varying, provided_id character varying, session_id bigint, rest_api_version character varying, registration_token bigint, scope client_scope
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF scope = 'FSS'::client_scope THEN
        PERFORM client_under_limit(owner_id, 1);
    ELSIF scope = 'MAPI'::client_scope THEN
        PERFORM mapi_client_under_limit(owner_id);
    END IF;
    RETURN QUERY INSERT INTO client (client_id, user_id, name, operating_system, version,
                                     provided_id, last_access, state, session_id, xid, rest_api_version, recovery,
                                     registration_token, scope)
        VALUES ($1, $2, $3, $4, $5, $6, transaction_timestamp(), 'ACTIVE', $7, xid_next($1), $8, FALSE, $9, $10) RETURNING *;
    PERFORM user_increment_xid(owner_id);
EXCEPTION
    WHEN unique_violation THEN -- Don't do anything
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_create
Schema: pod
Result Data Type: SETOF client
Argument Data Types: owner_id bigint, name character varying, os character varying, version character varying, provided_id character varying, session_id bigint, rest_api_version character varying, registration_token bigint, scope client_scope
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client_create(client_next_id($1), $1, $2, $3, $4, $5, $6, $7, $8, $9);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_create
Schema: pod
Result Data Type: SETOF client
Argument Data Types: owner_id bigint, name character varying, os character varying, version character varying, provided_id character varying, session_id bigint, rest_api_version character varying, scope client_scope
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client_create(client_next_id($1), $1, $2, $3, $4, $5, $6, $7, 0, $8);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_deactivate_ack
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET deactivate_ack = transaction_timestamp(),
            xid = xid_next(client_id)
        WHERE client_id = $1 AND state &lt;&gt; 'ACTIVE' AND deactivate_ack IS NULL
        RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_deregister_and_log_inactive_clients
Schema: pod
Result Data Type: bigint
Argument Data Types: user_identifier bigint, deregister_age_secs bigint, wipe boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    count BIGINT := 0;
    cur_client client;
BEGIN
    FOR cur_client IN SELECT * FROM client_deregister_inactive_clients($1, $2, $3) LOOP
        count := count + 1;

        PERFORM user_increment_xid(cur_client.user_id);
        PERFORM event_log_create(10035, cur_client.user_id, cur_client.user_id, cur_client.client_id, cur_client.client_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, event_args_to_string(cur_client.name));
    END LOOP;
    RETURN count;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_deregister_inactive_clients
Schema: pod
Result Data Type: SETOF client
Argument Data Types: user_identifier bigint, deregister_age_secs bigint, wipe boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET state = CASE WHEN $3 THEN 'WIPE'::client_state ELSE 'UNREGISTER'::client_state END,
              xid = xid_next(client_id)
        WHERE user_id = $1 AND state = 'ACTIVE'::client_state AND operating_system &lt;&gt; client_portal_os() AND
              (last_access + ($2 || ' seconds')::interval) &lt; transaction_timestamp()
        RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_disable_all
Schema: pod
Result Data Type: void
Argument Data Types: owner_id bigint, wipe boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT edp_filesystem_disassociate_all_user($1);
    UPDATE client SET state = CASE WHEN $2 THEN 'WIPE'::client_state ELSE 'UNREGISTER'::client_state END, xid = xid_next(client_id)
        WHERE user_id = $1 AND state = 'ACTIVE';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_gen_id
Schema: pod
Result Data Type: bigint
Argument Data Types: user_id bigint, sub_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT $1 | $2 | resource_type_client();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_increment_xid
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET xid = xid_next($1)
        WHERE client_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE client_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup
Schema: pod
Result Data Type: SETOF client
Argument Data Types: provided_id character varying, registration_token bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE provided_id = $1 AND registration_token = $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup
Schema: pod
Result Data Type: SETOF client
Argument Data Types: user_id bigint, provided_id character varying, scope client_scope
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE user_id = $1 AND provided_id = $2 AND scope = $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup_all
Schema: pod
Result Data Type: SETOF client
Argument Data Types: user_id bigint, VARIADIC scopes client_scope[]
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE user_id = $1 AND scope = ANY ($2);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup_all_active
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, max_results integer, VARIADIC scopes client_scope[]
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE client_id &gt; $1 AND state = 'ACTIVE' AND scope = ANY ($3) ORDER BY client_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_lookup_all_active
Schema: pod
Result Data Type: SETOF client
Argument Data Types: user_id bigint, VARIADIC scopes client_scope[]
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM client WHERE user_id = $1 AND state = 'ACTIVE' AND scope = ANY ($2);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT client_gen_id($1, user_next_sub_id($1));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_portal_name
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 'User Portal'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_portal_os
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 'Browser'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_portal_sub_id
Schema: pod
Result Data Type: integer
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2'::integer;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_portal_version
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 'None'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_reenable
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, name character varying, operating_system character varying, version character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT (c).* FROM (SELECT c, client_under_limit(c.user_id, 0), user_increment_xid(c.user_id) FROM
                       (SELECT * FROM client_reenable_int($1, $2, $3, $4)) AS c) AS cl;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_reenable_int
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, name character varying, operating_system character varying, version character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET state = 'ACTIVE', name = $2, operating_system = $3, version = $4, deactivate_ack = NULL,
            xid = xid_next($1), recovery = FALSE
        WHERE client_id = $1 AND state &lt;&gt; 'ACTIVE' RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_registered_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT count(*) FROM client WHERE state = 'ACTIVE';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_require_recovery
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET recovery = TRUE
        WHERE state = 'ACTIVE' AND operating_system IN ('WINDOWS', 'OSX', 'WINDOWS NSC', 'LINUX');
	--session_id needs to be reset for desktop/mobile/outlook which enforces re-auth. Hence, updates client table with latest settings.         
    UPDATE client SET xid = xid_next(client_id), session_id = -1 WHERE state = 'ACTIVE' 
    	AND operating_system NOT IN ('PUBLIC_API', 'MAPI');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_set_all_session_id
Schema: pod
Result Data Type: SETOF client
Argument Data Types: user_id bigint, session_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET session_id = $2, xid = xid_next(client_id) WHERE user_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_set_session_id
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, session_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET session_id = $2, xid = xid_next(client_id) WHERE client_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_state_change_from_active
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, state client_state
Volatility: volatile
Language: sql
Source Code:

    -- When deregistering client, also mark any associated ACTIVE EDP filesystems as INACTIVE.
    -- Right now edp is coupled with fss, in future if they are separate then will need to
    -- decouple this section too.
    SELECT edp_filesystem_disassociate_from_client($1);

    UPDATE client SET state = $2, xid = xid_next($1)
        WHERE client_id = $1 AND state = 'ACTIVE' RETURNING *

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_under_limit
Schema: pod
Result Data Type: boolean
Argument Data Types: owner_id bigint, adjust bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT limit_user_clients($1, count + $2) FROM
        (SELECT COUNT(*) FROM client WHERE user_id = $1 AND state = 'ACTIVE' AND scope = 'FSS'::client_scope) AS c;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: client_unregister
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT (c).* FROM (SELECT c, user_increment_xid(c.user_id)
        FROM client_state_change_from_active($1, 'UNREGISTER') as c) as cr;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, xid bigint, name character varying, os character varying, version character varying, recovery boolean, rest_api_version character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET name = $3, operating_system = $4, version = $5, recovery = $6,
        xid = xid_next($1), rest_api_version = $7
        WHERE client_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, xid bigint, name character varying, os character varying, version character varying, recovery boolean, rest_api_version character varying, registration_token bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET name = $3, operating_system = $4, version = $5, recovery = $6,
        xid = xid_next($1), rest_api_version = $7, registration_token = $8
        WHERE client_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update_access
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, access timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET last_access = $2
         WHERE client_id = $1 AND last_access &lt; $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update_name
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, name character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET name = $2, xid = xid_next($1)
        WHERE client_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update_provided_id
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint, provided_id character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET provided_id = $2, xid = xid_next($1)
        WHERE client_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update_registration_token
Schema: pod
Result Data Type: SETOF client
Argument Data Types: provided_client_id bigint, registration_token bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE client SET registration_token = $2, xid = xid_next($1)
        WHERE client_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_update_rest_api_version
Schema: pod
Result Data Type: SETOF client
Argument Data Types: provided_client_id bigint, rest_api_version character varying
Volatility: volatile
Language: sql
Source Code:

    WITH updated AS (
        UPDATE client SET rest_api_version = $2, xid = xid_next($1)
            WHERE client_id = $1 RETURNING *)
    SELECT (updated).* FROM (SELECT updated, user_increment_xid(updated.user_id) FROM updated) as u

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: client_wipe
Schema: pod
Result Data Type: SETOF client
Argument Data Types: client_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT (c).* FROM (SELECT c, user_increment_xid(c.user_id)
        FROM client_state_change_from_active($1, 'WIPE') as c) as cr;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: complete_extended_upgrade
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SET search_path TO pod,public;
    IF function_exist('extended_upgrade_cleanup') THEN
        PERFORM extended_upgrade_cleanup();
    END IF;

    -- Drop old filesystem schemas. 
    DROP SCHEMA IF EXISTS fs_func_v1 CASCADE;
    DROP SCHEMA IF EXISTS fs_1 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v20 CASCADE;
    DROP SCHEMA IF EXISTS fs_20 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v30 CASCADE;
    DROP SCHEMA IF EXISTS fs_30 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v40 CASCADE;
    DROP SCHEMA IF EXISTS fs_40 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v50 CASCADE;
    DROP SCHEMA IF EXISTS fs_50 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v60 CASCADE;
    DROP SCHEMA IF EXISTS fs_60 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v60 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v70 CASCADE;
    DROP SCHEMA IF EXISTS fs_70 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v70 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v80 CASCADE;
    DROP SCHEMA IF EXISTS fs_80 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v80 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v90 CASCADE;
    DROP SCHEMA IF EXISTS fs_90 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v90 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v100 CASCADE;
    DROP SCHEMA IF EXISTS fs_100 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v100 CASCADE;
    DROP SCHEMA IF EXISTS fs_func_v110 CASCADE;
    DROP SCHEMA IF EXISTS fs_110 CASCADE;
    DROP SCHEMA IF EXISTS mob_fs_func_v110 CASCADE;
    
    DROP TABLE IF EXISTS extended_upgrade_states;

    PERFORM include_files(db_sql_dir(), 'pod_funcs.sql');

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: content_id_next
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BIGINT;
BEGIN
    SELECT pod_number() | nextval('content_id_seq') INTO result;
    RETURN result;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========


Name: create_filesystem
Schema: pod
Result Data Type: bigint
Argument Data Types: filesystem_id bigint, owner_id bigint, type filesystem_type, label character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BIGINT;
BEGIN
    PERFORM fs_func_schema_set(fs_version_latest());
    EXECUTE $cf$ SELECT create_filesystem_fs($1, $2, $3, $4, $5) $cf$ 
    INTO result USING filesystem_id, owner_id, type, label, client_id;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: create_unique_label_name
Schema: pod
Result Data Type: character varying
Argument Data Types: name character varying, user_id bigint, VARIADIC states filesystem_state[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    i INTEGER := 1;
    unique_suffix VARCHAR;
    unique_name VARCHAR;
    fs_obj filesystem;
BEGIN
    fs_obj := find_user_filesystems_with_label(name, user_id, VARIADIC $3);
    IF fs_obj.fs_id IS NULL THEN
        RETURN name;
    END IF;

    LOOP
        unique_suffix := '(' || i || ')';
        SELECT SUBSTRING($1, 0, (limits()).entry_name - length(unique_suffix)) || unique_suffix
            INTO unique_name;
        fs_obj := find_user_filesystems_with_label(unique_name, user_id, VARIADIC $3);

        IF fs_obj.fs_id IS NULL THEN
            RETURN unique_name;
        END IF;
        i := i + 1;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: database_recovered
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT client_require_recovery();
    SELECT filesystem_recover_reset();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: database_sync_status
Schema: pod
Result Data Type: sync_status
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT CASE (SELECT sync_state FROM pg_stat_replication WHERE state = 'streaming')
        WHEN 'async' THEN
            'ASYNC'::sync_status
        WHEN 'sync' THEN
            'SYNC'::sync_status
        ELSE
            'DISCONNECTED'::sync_status
    END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: db_sql_dir
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '/opt/anywhere/db'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: delete_all_user_edp_filesystems
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: user_id bigint, clientid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM edp_filesystem_disassociate_all_user(user_id);
    RETURN QUERY EXECUTE $q$ SELECT * FROM delete_all_user_eligible_edp_filesystems($1, $2)
    $q$ USING user_id, clientid;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: delete_all_user_eligible_edp_filesystems
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: user_id bigint, clientid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY EXECUTE $q$ 
        SELECT (result.del).* FROM (SELECT edp_filesystem_delete($1, edp.fs_id, $2) del
            FROM edp_get_all_disassociated_active_filesystems_for_user($1) edp) AS result
    $q$ USING user_id, clientid;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_full_perms
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

    SELECT enum_range(NULL::dir_entry_permission);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_ro_perms
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

    SELECT '{&quot;READ&quot;}'::dir_entry_permission[];

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: dir_entry_wo_perms
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

    SELECT '{&quot;WRITE&quot;}'::dir_entry_permission[];

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_count_children
Schema: pod
Result Data Type: integer
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    result INTEGER;
BEGIN
    IF deleted AND NOT pruned THEN
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned, deleted);
        -- we are about to browse a mounted filesystem including deleted entries.
        -- Show the directory as it was at the time of the unmount (or now).  Don't show
        -- entries that were deleted before it was mounted.
        EXECUTE
            $q$ SELECT COUNT(*) FROM directory_list_at_time($1, $2, $3, $4, $5, $6) $q$
        USING full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter,
            CASE WHEN resolved_path.unmount_time IS NULL THEN now() ELSE resolved_path.unmount_time END,
            CASE WHEN resolved_path.unmount_time IS NULL AND resolved_path.type &lt;&gt; 'PRIVATE'::filesystem_type
                THEN resolved_path.shared_time ELSE resolved_path.mount_time END
        INTO result;
    ELSE
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned);
        EXECUTE
            $q$ SELECT COUNT(*) FROM directory_list($1, $2, $3, $4) $q$
        USING full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter
        INTO result;
    END IF;
    RETURN result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_count_children_at_time
Schema: pod
Result Data Type: integer
Argument Data Types: fs_id bigint, path character varying, filter directory_entry_filter, point_in_time timestamp with time zone
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    result INTEGER;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, path, true, true, point_in_time);
    EXECUTE
        $q$ SELECT COUNT(*) FROM directory_list_at_time($1, $2, $3, $4, $5, $6) $q$
    USING full_path(resolved_path.parent, resolved_path.name), false, false, filter,
          point_in_time, resolved_path.mount_time
    INTO result;
    RETURN result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_create
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, client_id bigint, implicit_creates boolean, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;
    PERFORM check_can_write(client_id, resolved_path);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT iq.up up, check_can_write(iq.up) FROM 
            (SELECT unresolve_path($1, $2, d) up FROM directory_create($3, $4, $5, $6, $7) d) AS iq) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
              resolved_path.name,  mtime, client_id, implicit_creates;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, version_id bigint, pruned boolean, record_read boolean, content_id bigint, client_id bigint, event version_event, args character varying, filter directory_entry_filter
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM directory_entry_lookup(fs_id, parent, name, version_id, pruned,
        record_read, content_id, client_id, event, args, FALSE, filter);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, version_id bigint, pruned boolean, record_read boolean, content_id bigint, client_id bigint, event version_event, args character varying, resolve_mountpoints boolean, filter directory_entry_filter, deleted boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), resolve_mountpoints, NOT pruned);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(parent, name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_entry_lookup($3, $4, $5, $6, $7, $8, $9, $10, $11, $12) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent, 
            resolved_path.name, version_id, pruned, record_read, content_id, client_id, event, args, deleted;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_at_time
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, point_in_time timestamp with time zone, record_read boolean, client_id bigint, event version_event, args character varying
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM directory_entry_lookup_at_time(fs_id, parent, name, point_in_time,
        record_read, client_id, event, args, FALSE);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_at_time
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, point_in_time timestamp with time zone, record_read boolean, client_id bigint, event version_event, args character varying, resolve_mountpoints boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, full_path(parent, name), 
        resolve_mountpoints, true, point_in_time);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_entry_lookup_at_time($3, $4, $5, $6, $7, $8, $9) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
            resolved_path.name, point_in_time, record_read, client_id, event, args;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_latest
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, pruned boolean, record_read boolean, content_id bigint, client_id bigint, event version_event, args character varying, resolve_mountpoints boolean, filter directory_entry_filter, deleted boolean DEFAULT false
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, full_path(parent, name), resolve_mountpoints, NOT pruned, deleted);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(parent, name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_entry_lookup($3, $4, $5, $6, $7, $8, $9, $10, $11, $12) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
            resolved_path.name, NULL::BIGINT, pruned, record_read, content_id, client_id, event, args, deleted;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_entry_lookup_version
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: private_fsid bigint, version_fsid bigint, version_id bigint, deleted boolean, pruned boolean, record_read boolean, client_id bigint, event version_event, args character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    version_fs filesystem;
BEGIN
    version_fs := set_path_read_fs(version_fsid);
    IF NOT sf_is_accessible_at_past_time(private_fsid, version_fs) THEN
        RETURN;
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_entry_lookup_by_version($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
    $q$ USING version_fsid, '/', version_id, deleted, pruned, TRUE, NULL::entry_type,
              record_read, client_id, event, args;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM directory_list($3, $4, $5, $6) d) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
              deleted, pruned, filter;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_backward
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    show_all_deleted BOOLEAN;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, path, true, true, point_in_time);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolve_path.parent, resolve_path.name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;

    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
            FROM directory_list_at_time_page_backward($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
    $q$ USING client_id, resolved_path,
        full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size, token, point_in_time,
        NULL::TIMESTAMPTZ, show_all_deleted;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_page_forward
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, page_size integer, token directory_list_page_token, point_in_time timestamp with time zone
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    show_all_deleted BOOLEAN;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, path, true, true, point_in_time);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
    show_all_deleted := resolved_path.unmount_time IS NOT NULL;
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;

    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
            FROM directory_list_at_time_page_forward($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
            $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size, token, point_in_time,
            NULL::TIMESTAMPTZ, show_all_deleted;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_at_time_with_offset
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, offset_cnt integer, page_size integer, entry_collation character varying, point_in_time timestamp with time zone, VARIADIC orderings offset_directory_list_order[]
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, path, true, true, point_in_time);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
            FROM directory_list_at_time_with_offset($3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) d) AS q
    $q$ USING client_id, resolved_path,
        full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, offset_cnt,
        page_size, entry_collation, point_in_time, NULL::TIMESTAMPTZ, FALSE, orderings;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_offset
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, offset_cnt integer, page_size integer, entry_collation character varying, VARIADIC orderings offset_directory_list_order[]
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    show_all_deleted BOOLEAN;
BEGIN
    IF deleted AND NOT pruned THEN
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned, deleted);
        -- we are about to browse a mounted filesystem including deleted entries.
        -- Show the directory as it was at the time of the unmount (or now).  Don't show
        -- entries that were deleted before it was mounted, except for current mounts of shared folders only.
        -- If the mountpoint was deleted, then we are browsing into a deleted directory, and
        -- all entries should show as deleted.
        show_all_deleted := resolved_path.unmount_time IS NOT NULL;
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_at_time_with_offset($3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, offset_cnt,
            page_size, entry_collation,
            CASE WHEN resolved_path.unmount_time IS NULL THEN now() ELSE resolved_path.unmount_time END,
            CASE WHEN resolved_path.unmount_time IS NULL AND resolved_path.type &lt;&gt; 'PRIVATE'::filesystem_type
                THEN resolved_path.shared_time ELSE resolved_path.mount_time END,
            show_all_deleted, orderings;
    ELSE
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned);
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_offset($3, $4, $5, $6, $7, $8, $9, $10) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, offset_cnt,
            page_size, entry_collation, orderings;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_backward
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, page_size integer, token directory_list_page_token
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    show_all_deleted BOOLEAN;
BEGIN
    IF deleted AND NOT pruned THEN
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned, deleted);
        -- we are about to browse a mounted filesystem including deleted entries.
        -- Show the directory as it was at the time of the unmount (or now).  Don't show
        -- entries that were deleted before it was mounted, except for current mounts of shared folders only.
        -- If the mountpoint was deleted, then we are browsing into a deleted directory, and
        -- all entries should show as deleted.
        show_all_deleted := resolved_path.unmount_time IS NOT NULL;
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_at_time_page_backward($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size,
            token,
            CASE WHEN resolved_path.unmount_time IS NULL THEN now() ELSE resolved_path.unmount_time END,
            CASE WHEN resolved_path.unmount_time IS NULL AND resolved_path.type &lt;&gt; 'PRIVATE'::filesystem_type
                THEN resolved_path.shared_time ELSE resolved_path.mount_time END,
            show_all_deleted;
    ELSE
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned);
        resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
        -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
        IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
                resolved_path.sync AND resolved_mountpoint_path.sync) THEN
            RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
        END IF;

        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_page_backward($3, $4, $5, $6, $7, $8) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size, token;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_page_forward
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint, page_size integer, token directory_list_page_token
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    show_all_deleted BOOLEAN;
BEGIN
    IF deleted AND NOT pruned THEN
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned, deleted);
        -- we are about to browse a mounted filesystem including deleted entries.
        -- Show the directory as it was at the time of the unmount (or now).  Don't show
        -- entries that were deleted before it was mounted, except for current mounts of shared folders only.
        -- If the mountpoint was deleted, then we are browsing into a deleted directory, and
        -- all entries should show as deleted.
        show_all_deleted := resolved_path.unmount_time IS NOT NULL;
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_at_time_page_forward($3, $4, $5, $6, $7, $8, $9, $10, $11) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size,
            token,
            CASE WHEN resolved_path.unmount_time IS NULL THEN now() ELSE resolved_path.unmount_time END,
            CASE WHEN resolved_path.unmount_time IS NULL AND resolved_path.type &lt;&gt; 'PRIVATE'::filesystem_type
                THEN resolved_path.shared_time ELSE resolved_path.mount_time END,
            show_all_deleted;
    ELSE
        resolved_path := resolve_path_read_fs(fs_id, path, true, NOT pruned);
        resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
        -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
        IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
                resolved_path.sync AND resolved_mountpoint_path.sync) THEN
            RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
        END IF;

        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_list_page_forward($3, $4, $5, $6, $7, $8) d) AS q
        $q$ USING client_id, resolved_path,
            full_path(resolved_path.parent, resolved_path.name), deleted, pruned, filter, page_size, token;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_list_subdirectories
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, filter directory_entry_filter, client_id bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, path, true, TRUE);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM directory_list_subdirectories($3, $4) d) AS q ORDER BY name
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name), filter;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, filter directory_entry_filter, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    is_sync BOOLEAN;
    user_id BIGINT;
    show_as_deleted BOOLEAN;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, path, false, NOT pruned, deleted);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
    is_sync := resolved_path.sync;
    IF resolved_path.sync AND filter = 'SYNCING_ONLY'::directory_entry_filter THEN
        SELECT owner_id FROM filesystem_lookup_one(fs_id) INTO user_id;
        is_sync = (SELECT sync FROM resolve_path(fs_id, user_id, path, true));
    END IF;
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(resolved_path.parent, resolved_path.name);
    END IF;
    IF deleted AND NOT pruned THEN
        show_as_deleted := resolved_path.unmount_time IS NOT NULL;
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up
                FROM directory_lookup_at_time_ext($3, $4, $5, $6, $7) d) AS q
        $q$ USING client_id, resolved_path,
                  full_path(resolved_path.parent, resolved_path.name), now(), deleted, pruned, show_as_deleted;
    ELSE
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM directory_lookup_ext($3, $4, $5) d) AS q
        $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
                  deleted, pruned;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_lookup_at_time
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, deleted boolean, pruned boolean, point_in_time timestamp with time zone, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    is_sync BOOLEAN;
    user_id BIGINT;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, path, FALSE, TRUE, point_in_time);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM directory_lookup_at_time_ext($3, $4, $5, $6, $7) d) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
              point_in_time, deleted, pruned, FALSE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_needs_recovery
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, path character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BOOLEAN;
BEGIN
    SELECT NOT exists(SELECT * FROM directory_lookup(fs_id, path, FALSE, FALSE, 
            'ALL_ENTRIES'::directory_entry_filter, client_id)) INTO result;
    RETURN result;
EXCEPTION
    WHEN raise_exception THEN
        IF SQLERRM LIKE 'PATH NOT FOUND:%' THEN
            RETURN TRUE;
        ELSE
            RAISE EXCEPTION '%', SQLERRM;
        END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_recover
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, dir_name character varying, mtime timestamp with time zone, client_id bigint, implicit_creates boolean, create_conflict boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    fs filesystem;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, dir_name), false);
    fs := filesystem_lookup_one(resolved_path.fs_id);
    IF fs.recovered_version IS NULL THEN
        RAISE EXCEPTION 'FILESYSTEM NOT IN RECOVERY: %', fs_id;
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT iq.up up FROM 
            (SELECT unresolve_path($1, $2, d) up FROM directory_create($3, $4, $5, $6, $7) d) AS iq) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent, resolved_path.name,  mtime, 
        client_id, implicit_creates;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: directory_restore
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, delta_secs integer, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    resolved_path_now resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, path, true, false, true);
    IF resolved_path IS NULL THEN
        RAISE EXCEPTION 'PATH NOT RESTORABLE';
    END IF;
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        -- Make sure not a cross-fs restore.  Path must *now* still reside in same share
        resolved_path_now := resolve_path_read_fs(fs_id, path, true, false);
        IF resolved_path_now IS NULL OR resolved_path_now.fs_id &lt;&gt; resolved_path.fs_id THEN
            RAISE EXCEPTION 'PATH NOT RESTORABLE';
        END IF;
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT iq.up up, check_can_write(iq.up) FROM 
            (SELECT unresolve_path($1, $2, d) up FROM directory_restore($3, $4, $5) d) AS iq) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
              delta_secs, client_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: does_schema_exist
Schema: pod
Result Data Type: boolean
Argument Data Types: schemaname character varying
Volatility: stable
Language: sql
Source Code:

    SELECT EXISTS(SELECT nspname FROM pg_namespace WHERE nspname = $1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: download_cleanup
Schema: pod
Result Data Type: bigint
Argument Data Types: idle_seconds integer, batchsize integer
Volatility: volatile
Language: sql
Source Code:

    SELECT count(*) FROM download_cleanup_int($1, $2);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_cleanup_int
Schema: pod
Result Data Type: SETOF timestamp with time zone
Argument Data Types: idle_seconds integer, batchsize integer
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM download WHERE CTID IN
      (SELECT CTID FROM download WHERE timestamp &lt; now() - ($1 || 'seconds')::INTERVAL LIMIT $2)
      RETURNING timestamp;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: download_create
Schema: pod
Result Data Type: SETOF download
Argument Data Types: parentpath character varying, point_in_time timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO download (id, parent_path, timestamp, point_in_time)
      VALUES (download_id_next(), $1, now(), $2) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_delete
Schema: pod
Result Data Type: SETOF download
Argument Data Types: id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM download WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_entry_pop
Schema: pod
Result Data Type: SETOF download_entry
Argument Data Types: downloadid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dl download;
    result download_entry;
    newpath VARCHAR;
BEGIN
    UPDATE download SET timestamp = now() WHERE id = $1 RETURNING * INTO dl;
    IF (dl.id IS NOT NULL) THEN
        DELETE FROM download_entry WHERE ctid IN (
            SELECT ctid FROM download_entry
                WHERE download_id = downloadid
                LIMIT 1
        ) RETURNING * INTO result;
        IF result.download_id IS NOT NULL THEN
            RETURN NEXT result;
        END IF;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_id_next
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('download_id_seq') | resource_type_download();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: download_lookup_by_id
Schema: pod
Result Data Type: SETOF download
Argument Data Types: download_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM download where id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_push_entries
Schema: pod
Result Data Type: SETOF download
Argument Data Types: downloadid bigint, VARIADIC paths character varying[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result download;
    newpath VARCHAR;
BEGIN
    UPDATE download SET timestamp = now() WHERE id = $1 RETURNING * INTO result;
    IF (result.id IS NOT NULL) THEN
        FOREACH newpath IN ARRAY paths LOOP
            CONTINUE WHEN newpath IS NULL; -- due to elvis list to array, we get an extra null entry at end
            INSERT INTO download_entry (download_id, path)
                VALUES (downloadid, newpath);
        END LOOP;
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: download_update
Schema: pod
Result Data Type: SETOF download
Argument Data Types: id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE download SET timestamp = now() WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_create
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: client_id bigint, label character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    edp_fs filesystem;
    fs_id BIGINT;
    user_id BIGINT;
    private_fs filesystem;
    path VARCHAR;
    unique_label VARCHAR;
BEGIN
    SELECT * from filesystem as fs where fs.client_id = $1 
        AND fs.state = 'ACTIVE'::filesystem_state 
        AND fs_is_edp(fs.type) INTO edp_fs;

    IF edp_fs.fs_id IS NULL THEN
        user_id := user_extract_id(client_id);
        fs_id := fs_next_edp_id();
        unique_label := create_unique_label_name(label, user_id, 'ACTIVE'::filesystem_state);
        PERFORM create_filesystem(fs_id, user_id, 'EDP'::filesystem_type, unique_label, $1);
        
        -- lookup and lock private filesystem
        private_fs := set_path_wlock_private_fs(user_id);
        IF private_fs.version &lt;&gt; fs_version_latest() THEN
            PERFORM upgrade_filesystem(private_fs);
            SELECT * FROM set_path_wlock_private_fs(user_id) INTO private_fs;
        END IF;
        
        EXECUTE $q$ SELECT * FROM directory_create_mountpoint($1, '/', $2, $3, FALSE) $q$ 
            USING fs_id, unique_label, client_id INTO path;
        IF path IS NULL THEN
            RAISE EXCEPTION 'MOUNTPOINT NOT CREATED: %', fsid; -- should never happen, but just in case
        END IF;
        RETURN QUERY EXECUTE $q$ SELECT f.*, $1, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role 
            FROM filesystem f, 
	            directories_lookup_mountpoints($2, FALSE) mp WHERE f.state = 'ACTIVE' 
	                AND fs_is_edp(f.type) 
	                AND f.fs_id = mp.fs_id 
            $q$ USING user_id, path;
    ELSE
        RAISE EXCEPTION 'EDP FILESYSTEM ALREADY EXISTS FOR CLIENT';
    END IF;
EXCEPTION
    WHEN unique_violation THEN
        RAISE EXCEPTION 'DUPLICATE LABEL'; -- this technically shouldn't happen
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_delete
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: userid bigint, fsid bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    edp_fsid BIGINT;
    edp_fs  filesystem;
    result RECORD;
BEGIN
    -- lock the user's private filesystem, and set path to it
    private_fs := set_path_wlock_private_fs(userid);

    -- query to get the fs_id for user where the edp fs was disassociated from client
    EXECUTE $q$
        SELECT * FROM filesystem fs WHERE fs.owner_id = $1 AND fs_is_edp(fs.type)
            AND fs.client_id IS NULL AND fs.fs_id = $2
    $q$ USING userid, fsid INTO result;
    edp_fsid := result.fs_id;
    
    IF edp_fsid IS NULL THEN
        RAISE EXCEPTION 'CANNOT DELETE. EDP FILESYSTEM NOT FOUND OR STILL HAS AN ASSOCIATED CLIENT: %', fsid; -- did not find fs
    END IF;

    -- lock the edp filesystem
    edp_fs := set_path_wlock_fs(edp_fsid);

    -- make sure the passed in owner is really the owner
    IF edp_fs.owner_id &lt;&gt; private_fs.owner_id THEN
        RAISE EXCEPTION 'DELETE EDP FILESYSTEM BY NONOWNER';
    END IF;

    -- Add DELETE events for all objects in edp schema
    -- Need to do entry_delete_all() instead of delete_all() because delete_all() marks items as pruned
    -- which will not appear in UP when show deleted is checked (we want to be able to show deleted edp files)
    EXECUTE $q$
        SELECT entry_delete_all($1)
    $q$ USING client_id;
    
    -- unmount the edp share from user's private fs
    PERFORM set_path_wlock_private_fs(userid);
    EXECUTE $q$
        SELECT directory_delete_mountpoint_to_fs($1, $2)
    $q$ USING edp_fs.fs_id, client_id;
    
    -- Mark the filesystem as inactive
    PERFORM filesystem_mark_inactive(edp_fs.fs_id);

    PERFORM edp_log_filesystem_marked_inactive(edp_fs);

    RETURN QUERY SELECT * FROM filesystem WHERE fs_id = fsid AND state = 'INACTIVE';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_disassociate_all_user
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    WITH affected AS (
        UPDATE filesystem new SET client_id = NULL
        FROM filesystem old
        WHERE new.fs_id = old.fs_id AND old.client_id IS NOT NULL AND old.state = 'ACTIVE'::filesystem_state
            AND fs_is_edp(old.type) AND old.owner_id = $1 RETURNING new.fs_id, old.client_id AS old_client_id
    ) SELECT edp_log_client_disassociated(af.old_client_id, af.fs_id) FROM affected af;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_disassociate_from_client
Schema: pod
Result Data Type: void
Argument Data Types: given_client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    affected_fs BIGINT;
BEGIN
    UPDATE filesystem SET client_id = NULL
        WHERE client_id = $1 AND state = 'ACTIVE'::filesystem_state
            AND fs_is_edp(type) RETURNING fs_id INTO affected_fs;
    PERFORM edp_log_client_disassociated($1, affected_fs);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_lookup
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_user_private_fs(user_extract_id(client_id));
    RETURN QUERY EXECUTE $q$ SELECT f.*, f.owner_id, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role FROM filesystem f, 
        directories_lookup_mountpoints(NULL::VARCHAR, FALSE) mp WHERE f.state = 'ACTIVE' 
            AND fs_is_edp(f.type) AND f.client_id = $1
            AND f.fs_id = mp.fs_id 
        $q$ USING client_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_filesystem_lookup_by_filesystem_id
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: fs_id bigint, user_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_user_private_fs(user_extract_id(user_id));
    RETURN QUERY EXECUTE $q$ SELECT f.*, f.owner_id, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role
        FROM filesystem f, directories_lookup_mountpoints(NULL::VARCHAR, FALSE) mp 
        WHERE fs_is_edp(f.type) AND f.fs_id = $1 AND f.fs_id = mp.fs_id
        $q$ USING fs_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_get_all_disassociated_active_filesystems_for_user
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM filesystem fs WHERE fs.owner_id = $1 AND fs_is_edp(fs.type)
        AND fs.state = 'ACTIVE' AND fs.client_id IS NULL;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_list_mounted_filesystems
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT edp_filesystem_lookup_by_filesystem_id(mf.fs_id, mf.owner_id) 
        FROM sf_lookup_all_joined_shared_folders($1, FALSE, FALSE) mf 
        WHERE fs_is_edp(mf.type);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_log_client_disassociated
Schema: pod
Result Data Type: void
Argument Data Types: client_id bigint, fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    disassociated_client client;
    deleting_user user_account;
    affected_fs filesystem;
    user_args VARCHAR;
    system_args VARCHAR;
BEGIN
    IF fs_id IS NOT NULL THEN
        disassociated_client := client_lookup($1);
        deleting_user := user_lookup(disassociated_client.user_id);
        affected_fs = filesystem_lookup($2);
        user_args := event_args_to_string(disassociated_client.name, affected_fs.label);
        system_args := event_args_to_string(deleting_user.name, disassociated_client.name);
        PERFORM event_log_create(10078, deleting_user.user_id, deleting_user.user_id,
                                 disassociated_client.client_id, affected_fs.fs_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, user_args);
        PERFORM event_log_create(3328, deleting_user.user_id, deleting_user.user_id,
                                 disassociated_client.client_id, affected_fs.fs_id, NULL,
                                 'MOBILE_SYSTEM'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, system_args);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_log_filesystem_marked_inactive
Schema: pod
Result Data Type: void
Argument Data Types: fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    owner user_account;
    user_args VARCHAR;
    system_args VARCHAR;
BEGIN
    owner := user_lookup(fs.owner_id);
    user_args := event_args_to_string(fs.label);
    system_args = event_args_to_string(owner.name, fs.label);
    PERFORM event_log_create(10079, owner.user_id, owner.user_id, NULL, fs.fs_id, NULL,
                             'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                             'GENERAL'::event_facility, FALSE, NULL, user_args);
    PERFORM event_log_create(3329, owner.user_id, owner.user_id, NULL, fs.fs_id, NULL,
                             'MOBILE_SYSTEM'::event_scope, 'NOTICE'::event_severity,
                             'GENERAL'::event_facility, FALSE, NULL, system_args);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_lookup_folders_under_path
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, path character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM sf_lookup_joined_shared_folders_under_path(userid, path) 
        WHERE fs_is_edp(type);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_metrics
Schema: pod
Result Data Type: record
Argument Data Types: OUT edp_active_devices_count bigint, OUT edp_disassociated_devices_count bigint, OUT edp_total_files bigint, OUT edp_total_file_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
	SELECT get_edp_count(FALSE) INTO edp_active_devices_count;
	SELECT get_edp_count(TRUE) INTO edp_disassociated_devices_count;
    SELECT coalesce(sum(file_count), 0), coalesce(sum(sum_file_size), 0) 
        FROM filesystem fs
        WHERE fs_is_edp(fs.type) AND fs.state = 'ACTIVE'::filesystem_state 
        INTO edp_total_files, edp_total_file_size;
END 

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: edp_resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: clientid bigint, fsid bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    SELECT * FROM filesystem WHERE fs_id = fsid INTO fs;
    RETURN CASE WHEN (clientid = fs.client_id OR (fs.client_id IS NULL 
        AND fs.type = 'EDP'::filesystem_type)) THEN dir_entry_full_perms() ELSE dir_entry_ro_perms() END;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    mounted_fs mounted_filesystem_result;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, parent_path, false, TRUE);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM
            (SELECT unresolve_path($1, $2, d) up FROM entries_find($3, $4, $5, $6, $7) d) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
              pattern, deleted, max_results, filter;

    IF resolved_path.fs_id = fs_id THEN
        FOR mounted_fs IN
            SELECT * FROM sf_lookup_joined_shared_folders_under_path(user_extract_id(fs_id), parent_path) LOOP
            PERFORM set_path_read_fs(mounted_fs.fs_id);
            RETURN QUERY EXECUTE $q$
                SELECT (q.up).* FROM
                    (SELECT unresolve_path($1, $2, d) up FROM entries_find($3, $4, $5, $6, $7) d) AS q
            $q$ USING client_id, mounted_fs, '/', pattern, deleted, max_results, filter;
        END LOOP;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_at_time
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, pattern character varying, deleted boolean, max_results integer, filter directory_entry_filter, client_id bigint, point_in_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    mountpoint mount_point_result;
BEGIN
    resolved_path := resolve_path_at_time_read_fs(fs_id, parent_path, false, true, point_in_time);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM
            (SELECT unresolve_path($1, $2, d) up FROM entries_find_at_time($3, $4, $5, $6, $7, $8) d) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name),
              pattern, deleted, max_results, filter, point_in_time;

    IF resolved_path.fs_id = fs_id THEN
        FOR mountpoint IN EXECUTE
            $q$ SELECT * FROM entries_lookup_mountpoints_under_path_at_time($1, $2) $q$
            USING parent_path, point_in_time
        LOOP
            resolved_path := resolve_path_at_time_read_fs(fs_id, mountpoint.mounted_path, true, false, point_in_time);
            IF resolved_path.fs_id IS NULL THEN
                RAISE NOTICE 'Cannot resolve mountpoint % to point in time in past', mountpoint;
            ELSE
                RETURN QUERY EXECUTE $q$
                    SELECT (q.up).* FROM
                        (SELECT unresolve_path($1, $2, d) up FROM entries_find_at_time($3, $4, $5, $6, $7, $8) d) AS q
                $q$ USING client_id, resolved_path, '/', pattern, deleted, max_results, filter, point_in_time;
            END IF;
        END LOOP;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_find_conflicts
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    mounted_fs mounted_filesystem_result;
BEGIN
    private_fs := set_path_read_private_fs(fs_id);
    RETURN QUERY EXECUTE $q$ SELECT * FROM entries_find_conflicts() $q$;

    FOR mounted_fs IN SELECT * FROM sf_lookup_all_joined_shared_folders(private_fs.owner_id, FALSE, FALSE) LOOP
        PERFORM set_path_read_fs(mounted_fs.fs_id);
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM
                (SELECT unresolve_path($1, $2, d) up FROM entries_find_conflicts() d) AS q
        $q$ USING client_id, mounted_fs;
    END LOOP;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: entries_lookup_all
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, path character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_read_fs(fs_id, path, false, TRUE);
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_read_fs(fs_id);
        RETURN QUERY EXECUTE $q$
            SELECT (q.up).* FROM
                (SELECT unresolve_path($1, NULL::TIMESTAMPTZ, $2, dir_entry_full_perms(), d) up FROM entries_lookup_all($3) d) AS q
        $q$ USING fs_id, '/', resolved_path.mountpoint_path;
        PERFORM set_path_read_fs(resolved_path.fs_id);
    END IF;

    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM
            (SELECT unresolve_path($1, $2, d) up FROM entries_lookup_all($3) d) AS q
    $q$ USING client_id, resolved_path, full_path(resolved_path.parent, resolved_path.name);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_copy_restrict
Schema: pod
Result Data Type: void
Argument Data Types: src_fsid bigint, src_path character varying, src_name character varying, dest_fsid bigint, dest_path character varying
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    IF src_fsid = dest_fsid AND (normalize(src_path) = normalize(dest_path)
       OR position(normalize(full_path(src_path, src_name) || '/') IN normalize(dest_path || '/')) = 1) THEN
        RAISE EXCEPTION 'INVALID COPY DESTINATION : % -&gt; %', full_path(src_path, src_name),
                                                             full_path(dest_path, src_name);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_rename
Schema: pod
Result Data Type: record
Argument Data Types: src_fsid bigint, src_path character varying, src_name character varying, src_contentid bigint, dest_fsid bigint, dest_path character varying, dest_name character varying, client_id bigint, make_dirs boolean, create_conflict boolean, copy_deletes boolean, hide_deletes_earlier_than timestamp with time zone, event version_event, version_hide boolean, OUT move_result dir_entry_result, OUT dest_mountpoints mount_point_result[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result RECORD;
BEGIN
    EXECUTE
        $q$ SELECT * FROM directory_entry_rename($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14, $15, $16) $q$
        USING src_path, src_name, src_contentid, dest_fsid, dest_path, dest_name, client_id,
            make_dirs, create_conflict, TRUE, event, NULL::version_event, NULL::VARCHAR,
            copy_deletes, hide_deletes_earlier_than, version_hide
        INTO result;
        
    PERFORM check_can_write(result.move_result);
    
    move_result := result.move_result;
    dest_mountpoints := result.dest_mountpoints;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_rename_cleanup
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $q$ SELECT * FROM directory_entry_rename_cleanup() $q$;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_rename_prepare
Schema: pod
Result Data Type: void
Argument Data Types: dest_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $q$ SELECT * FROM directory_entry_rename_prepare($1) $q$ USING dest_fsid;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: entry_rename_restrict
Schema: pod
Result Data Type: void
Argument Data Types: src_path character varying, dest_path character varying
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    IF normalize(src_path) = normalize(dest_path)
       OR position(normalize(src_path || '/') IN normalize(dest_path)) = 1 THEN
        RAISE EXCEPTION 'INVALID RENAME DESTINATION : % -&gt; %', src_path, dest_path;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_args_to_string
Schema: pod
Result Data Type: character varying
Argument Data Types: VARIADIC args character varying[]
Volatility: immutable
Language: plpgsql
Source Code:

DECLARE
    result VARCHAR;
    arg TEXT;
    first BOOLEAN;
BEGIN
    result := '[&quot;';
    first := TRUE;
    FOREACH arg IN ARRAY args LOOP
        if NOT first THEN
            result := result || '&quot;,&quot;';
        END IF;
        result := result || arg;
        first := FALSE;
    END LOOP;
    RETURN result || '&quot;]';
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_facility_to_array
Schema: pod
Result Data Type: event_facility[]
Argument Data Types: VARIADIC facilities event_facility[]
Volatility: volatile
Language: sql
Source Code:

    SELECT $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_create
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: new_event_type integer, new_aff_user_id bigint, new_user_id bigint, new_client_id bigint, new_aff_resource_id bigint, new_path character varying, new_scope event_scope, new_severity event_severity, new_facility event_facility, new_major boolean, new_message character varying, new_args character varying
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO event_log(timestamp, tsextra, event_type, aff_user_id, user_id, client_id,
          aff_resource_id, path, scope, severity, facility, major, message, args)
        VALUES (statement_timestamp(), tsextra_next(), $1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, 
                $12)
        RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_filter
Schema: pod
Result Data Type: boolean
Argument Data Types: log event_log, severities event_severity[], facilities event_facility[], majoronly boolean
Volatility: immutable
Language: sql
Source Code:

    SELECT  ($1.severity = ANY($2))
        AND ($1.facility = ANY($3))
        AND CASE WHEN $4 THEN $1.major = TRUE ELSE TRUE END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_filter_event_types
Schema: pod
Result Data Type: boolean
Argument Data Types: log event_log, inclorexcleventtypes boolean, eventtypes integer[]
Volatility: immutable
Language: sql
Source Code:

    SELECT 
        CASE WHEN ($2 IS NULL OR $3 IS NULL) THEN TRUE
        ELSE
             CASE WHEN $2 THEN $1.event_type = ANY($3) 
                  ELSE $1.event_type != ALL($3) 
             END
        END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_access_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, begintimestamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'ACCESS'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &gt; ($4, $5)
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_access_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'ACCESS'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &lt; ($4, $5)
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_affected_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: scope event_scope, affected_resource_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, begintimstamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = $1 AND aff_resource_id IS NOT NULL
        AND aff_resource_id = $2
        AND event_log_filter(event_log, $3, $4, $5)
        AND (timestamp, tsextra) &gt; ($6, $7)
        ORDER BY timestamp, tsextra
        LIMIT $8;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_affected_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: scope event_scope, affected_resource_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = $1 AND aff_resource_id IS NOT NULL
        AND aff_resource_id = $2
        AND event_log_filter(event_log, $3, $4, $5)
        AND (timestamp, tsextra) &lt; ($6, $7)
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $8;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_device_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: device_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, begintimstamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log_lookup_affected_after('REMOTE'::event_scope, $1, $2, $3, $4, $5, $6, $7);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_device_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: device_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log_lookup_affected_before('REMOTE'::event_scope, $1, $2, $3, $4, $5, $6, $7);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_mobile_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: aff_resource_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, begintimstamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log_lookup_affected_after('MOBILE_USER'::event_scope, $1, $2, $3, $4, $5, $6, $7);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_mobile_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: aff_resource_id bigint, severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log_lookup_affected_before('MOBILE_USER'::event_scope, $1, $2, $3, $4, $5, $6, $7);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_mobile_system_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, begintimestamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'MOBILE_SYSTEM'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &gt; ($4, $5)
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_mobile_system_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'MOBILE_SYSTEM'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &lt; ($4, $5)
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_remote_system_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, begintimestamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'REMOTE'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &gt; ($4, $5)
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_remote_system_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'REMOTE'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &lt; ($4, $5)
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_system_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, begintimestamp timestamp with time zone, begintsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'SYSTEM'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &gt; ($4, $5)
        ORDER BY timestamp, tsextra
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_system_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM event_log WHERE scope = 'SYSTEM'
        AND event_log_filter(event_log, $1, $2, $3)
        AND (timestamp, tsextra) &lt; ($4, $5)
        ORDER BY timestamp DESC, tsextra DESC
        LIMIT $6;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_user_after
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: user_id bigint, inclorexcleventtypes boolean, eventtypes integer[], severities event_severity[], facilities event_facility[], majoronly boolean, begintimstamp timestamp with time zone, begintsextra smallint, maxrecords integer, show_all boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    IF show_all THEN
        RETURN QUERY SELECT * FROM event_log WHERE scope = 'MOBILE_USER' AND aff_user_id IS NOT NULL
            AND aff_user_id = $1
            AND event_log_filter(event_log, $4, $5, $6)
            AND event_log_filter_event_types(event_log, $2, $3)
            AND (timestamp, tsextra) &gt; ($7, $8)
            ORDER BY timestamp, tsextra
            LIMIT $9;
    ELSE
        RETURN QUERY SELECT * FROM event_log WHERE scope = 'MOBILE_USER' AND aff_user_id IS NOT NULL
            AND aff_user_id = $1
            AND event_log_filter(event_log, $4, $5, $6)
            AND event_log_filter_event_types(event_log, $2, $3)
            AND (timestamp, tsextra) &gt; ($7, $8)
            AND (timestamp, tsextra) &gt; (coalesce((select enable_time from user_account where user_account.user_id = $1),(select to_timestamp(0))),0)
            ORDER BY timestamp, tsextra
            LIMIT $9;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_log_lookup_user_before
Schema: pod
Result Data Type: SETOF event_log
Argument Data Types: user_id bigint, inclorexcleventtypes boolean, eventtypes integer[], severities event_severity[], facilities event_facility[], majoronly boolean, endtimestamp timestamp with time zone, endtsextra smallint, maxrecords integer, show_all boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    IF show_all THEN
        RETURN QUERY SELECT * FROM event_log WHERE scope = 'MOBILE_USER' AND aff_user_id IS NOT NULL
            AND aff_user_id = $1
            AND event_log_filter(event_log, $4, $5, $6)
            AND event_log_filter_event_types(event_log, $2, $3)
            AND (timestamp, tsextra) &lt; ($7, $8)
            ORDER BY timestamp DESC, tsextra DESC
            LIMIT $9;
    ELSE
        RETURN QUERY SELECT * FROM event_log WHERE scope = 'MOBILE_USER' AND aff_user_id IS NOT NULL
            AND aff_user_id = $1
            AND event_log_filter(event_log, $4, $5, $6)
            AND event_log_filter_event_types(event_log, $2, $3)
            AND (timestamp, tsextra) &lt; ($7, $8)
            AND (timestamp, tsextra) &gt; (coalesce((select enable_time from user_account where user_account.user_id = $1),(select to_timestamp(0))),0)
            ORDER BY timestamp DESC, tsextra DESC
            LIMIT $9;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: event_severity_to_array
Schema: pod
Result Data Type: event_severity[]
Argument Data Types: VARIADIC severities event_severity[]
Volatility: volatile
Language: sql
Source Code:

    SELECT $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========



Name: failed_fs_upgrade_attempts_exist
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT * FROM filesystem WHERE upgrade_attempts &gt;= get_max_fs_upgrade_attempts_config());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: file_change_lookup
Schema: pod
Result Data Type: SETOF file_change_result
Argument Data Types: user_id bigint, fs_id bigint, xid bigint, maxrecords bigint, includensc boolean
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    has_access BOOLEAN;
BEGIN
    fs := set_path_read_fs(fs_id);
    IF fs.type = 'SHARED'::filesystem_type OR fs.type = 'TEAM'::filesystem_type THEN
        has_access := sf_is_user_member(user_id, fs_id);
    ELSE
        has_access := (fs.owner_id = user_id);
    END IF;
    IF NOT has_access THEN
        RAISE EXCEPTION 'ACCESS FORBIDDEN: %', fs_id;
    END IF;
    RETURN QUERY EXECUTE $q$ SELECT * FROM file_change_lookup($1, $2, $3, $4) $q$
        USING xid, fs.xid, maxrecords,includeNsc;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_close
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, prev_content_id bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, size bigint, hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean, from_link_upload boolean, is_anonymous boolean, args character varying, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    object visible_object;
    result dir_entry_result;
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(parent_path, file_name);
    END IF;
    object := object_close(object_path, size, hash);
    IF object.size IS NOT NULL THEN
        EXECUTE $q$ SELECT * FROM file_close($1, NULL::BIGINT, NULL::BIGINT, $2, $3, $4, $5, $6, $7,
                $8, $9, $10, $11, $12, $13, $14, NULL::TID) $q$
            INTO result USING prev_content_id, resolved_path.parent, resolved_path.name, mtime, size, hash,
                object.storage_id, object.path, client_id, implicit_creates, create_conflict, from_link_upload,
                is_anonymous, args;
        IF result.version_id IS NOT NULL THEN
            result := unresolve_path(client_id, resolved_path, result);
            PERFORM check_can_write(result);
            RETURN NEXT result;
        ELSE
            RAISE EXCEPTION 'Failed to close file: %', full_path(parent_path, file_name);
        END IF;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_close_new
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, size bigint, hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean, from_link_upload boolean, is_anonymous boolean, args character varying, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT file_close($1, NULL::BIGINT, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, $14);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_create
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean, filter directory_entry_filter
Volatility: volatile
Language: sql
Source Code:

    SELECT file_create_version($1, NULL::BIGINT, $2, $3, $4, $5, $6, $7, $8, $9, $10);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_create_version
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, prev_content_id bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
    o_result RECORD;
    resolved_path resolved_path;
    resolved_mountpoint_path resolved_path;
    object_tid TID;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    resolved_mountpoint_path := resolve_path(fs_id, user_extract_id(client_id), full_path(resolved_path.parent, resolved_path.name), true, false);
    -- Check if syncing client and if path is unsyncing or is unsyncing mountpoint
    IF NOT apply_directory_entry_filter(filter, CASE WHEN resolved_path.fs_id &lt;&gt; fs_id THEN resolved_path.fs_id ELSE resolved_mountpoint_path.fs_id END,
            resolved_path.sync AND resolved_mountpoint_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(parent_path, file_name);
    END IF;
    SELECT * FROM object_lookup_update(new_size, new_hash) INTO o_result;
    object_tid := o_result.row_tid;
    IF object_tid IS NOT NULL THEN
        EXECUTE $q$ SELECT * FROM file_close($1, NULL::BIGINT, NULL::BIGINT, $2, $3, $4, $5, $6,
                NULL::BIGINT, NULL::VARCHAR, $7, $8, $9, FALSE, FALSE, NULL::VARCHAR, $10) $q$
            USING prev_content_id, resolved_path.parent, resolved_path.name,
                  mtime, new_size, new_hash, client_id,
                  implicit_creates, create_conflict, object_tid
            INTO result;
        IF result.name IS NULL THEN
            RAISE EXCEPTION 'Failed to close file: %', full_path(parent_path, file_name);
        END IF;
        result := unresolve_path(client_id, resolved_path, result);
        PERFORM check_can_write(result);
        RETURN NEXT result;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_mark_complete
Schema: pod
Result Data Type: SETOF boolean
Argument Data Types: object_path character varying, closing_size bigint, closing_hash bytea
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM object_close_int($1, $2, $3, 0);
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_mark_failed
Schema: pod
Result Data Type: SETOF boolean
Argument Data Types: object_path character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE invisible_object SET state = 'FAILED' 
        WHERE path = $1 AND state = 'IN_PROGRESS' 
        RETURNING TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_needs_recovery
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, path character varying, client_version bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BOOLEAN;
BEGIN
    SELECT client_version &gt;= (flo.fs).recovered_version
        FROM (
           SELECT filesystem_lookup_one(rprf.fs_id) fs
               FROM resolve_path_read_fs(fs_id, path, TRUE, TRUE) rprf
        ) AS flo
        INTO result;
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_open
Schema: pod
Result Data Type: character varying
Argument Data Types: fs_id bigint, parent character varying, name character varying, size bigint, hash bytea, storage_id bigint, OUT result character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM resolve_path_read_fs(fs_id, full_path(parent, name), TRUE, TRUE);
    INSERT INTO invisible_object(path, size, hash, storage_id, state, change_time)
        VALUES (mk_path(nextval('object_id_seq')), $4, $5, $6, 'IN_PROGRESS',
                transaction_timestamp())
        RETURNING path INTO result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_open_with_temp
Schema: pod
Result Data Type: record
Argument Data Types: fs_id bigint, parent character varying, name character varying, size bigint, hash bytea, storageid bigint, OUT storage_path character varying, OUT temp_path character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    storage_path := file_open(fs_id, parent, name, size, hash, storageid);
    IF storage_path IS NOT NULL THEN
        INSERT INTO invisible_object(path, storage_id, state, change_time)
            VALUES (mk_path(nextval('object_id_seq')), storageid, 'IN_PROGRESS', transaction_timestamp())
            RETURNING path INTO temp_path;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_recover
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, client_content bigint, client_version bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
BEGIN
    IF fs_is_edp(fs_id) THEN
        SELECT * FROM file_recover_fs_root(fs_id, client_content, client_version, parent_path,
                                          file_name, mtime, object_path, new_size, new_hash,
                                          client_id, implicit_creates, create_conflict) INTO result;
    ELSE
        SELECT * FROM file_recover_mountpoint(fs_id, client_content, client_version, parent_path,
                                              file_name, mtime, object_path, new_size, new_hash,
                                              client_id, implicit_creates, create_conflict) INTO result;
    END IF;
    RETURN NEXT result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_recover_core
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, client_content bigint, client_version bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    o_result RECORD;
    row_tid TID;
    object visible_object;
    result dir_entry_result;
BEGIN
    fs := filesystem_lookup_one(fs_id);
    IF fs.recovered_version IS NULL THEN
        RAISE EXCEPTION 'FILESYSTEM NOT IN RECOVERY: %', fs_id;
    ELSIF fs.recovered_version &gt; client_version AND client_content IS NULL THEN
        RAISE EXCEPTION 'VERSION BEFORE RECOVERY: % &gt; %', fs.recovered_version, client_version;
    ELSIF object_path IS NULL THEN
        -- todo:  is this right with respect to chunking?
        SELECT * FROM object_lookup_update(new_size, new_hash) INTO o_result;
        row_tid := o_result.row_tid;
        IF row_tid IS NULL THEN
            RETURN;
        END IF;
    ELSE
        SELECT * FROM object_close(object_path, new_size, new_hash) INTO object;
    END IF;
    EXECUTE $q$
        SELECT * FROM file_close($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13, FALSE,
            FALSE, NULL::VARCHAR, $14)
    $q$
        INTO result
        USING client_content, client_version, fs.recovered_version, parent_path,
            file_name, mtime, new_size, new_hash, object.storage_id, object.path,
            client_id, implicit_creates, create_conflict, row_tid;
    RETURN NEXT result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_recover_fs_root
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, client_content bigint, client_version bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
BEGIN
    PERFORM set_path_read_fs(fs_id);
    EXECUTE $q$
        SELECT * FROM file_recover_core($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)
    $q$
        INTO result
        USING fs_id, client_content, client_version, parent_path, file_name, mtime, object_path,
              new_size, new_hash, client_id, implicit_creates, create_conflict;
    IF result.version_id IS NOT NULL THEN
        RETURN NEXT result;
    ELSE
        RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(parent_path, file_name);
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_recover_mountpoint
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, client_content bigint, client_version bigint, parent_path character varying, file_name character varying, mtime timestamp with time zone, object_path character varying, new_size bigint, new_hash bytea, client_id bigint, implicit_creates boolean, create_conflict boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result dir_entry_result;
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    EXECUTE $q$
        SELECT * FROM file_recover_core($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)
    $q$
        INTO result
        USING resolved_path.fs_id, client_content, client_version, resolved_path.parent,
              resolved_path.name, mtime, object_path, new_size, new_hash, client_id, implicit_creates,
              create_conflict;
    IF result.version_id IS NOT NULL THEN
        result := unresolve_path(client_id, resolved_path, result);
        RETURN NEXT result;
    ELSE
        RAISE EXCEPTION 'PATH NOT FOUND: %', full_path(parent_path, file_name);
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: file_restore_latest
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent, name), false);
    PERFORM check_can_write(client_id, resolved_path);

    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM 
            (SELECT iq.up up, check_can_write(iq.up) 
                FROM (SELECT unresolve_path($1, $2, d) up FROM file_restore_latest($3, $4, $5) d) AS iq) AS q 
    $q$ USING client_id, resolved_path, resolved_path.parent, resolved_path.name, client_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_conflict_total_for_user
Schema: pod
Result Data Type: numeric
Argument Data Types: user_id bigint, OUT conflicts numeric
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT coalesce(
        (SELECT SUM(conflict_count) FROM filesystem f, shared_folder_membership m
         WHERE m.user_id = $1 AND m.state = 'MEMBER' AND m.fs_id = f.fs_id), 0) +
         (SELECT conflict_count FROM filesystem WHERE owner_id = $1 AND type = 'PRIVATE' AND state = 'ACTIVE')
        INTO conflicts;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_delete
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET sum_file_size = 0, file_count = 0, dir_count = 0, conflict_count = 0,
        state = 'DELETED'::filesystem_state, joined_count = 0, invited_count = 0
        WHERE fs_id = $1 RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_file_count
Schema: pod
Result Data Type: numeric
Argument Data Types: fs_id bigint, OUT count numeric
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT sum(file_count) + sum(dir_count) FROM filesystem f WHERE f.fs_id = $1 INTO count;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_list
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: start bigint, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE fs_id &gt; $1 AND state &lt;&gt; 'DELETED'::filesystem_state ORDER BY fs_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: fs_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM filesystem WHERE fs_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_all_after
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: after_fsid bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE fs_id &gt; $1 AND state &lt;&gt; 'DELETED'::filesystem_state
        ORDER BY fs_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_lock
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint, OUT filesystem filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem f
        WHERE f.fs_id = $1 AND state &lt;&gt; 'DELETED'::filesystem_state FOR UPDATE NOWAIT
        INTO filesystem;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_one
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint, OUT filesystem filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem f WHERE f.fs_id = $1 
        INTO filesystem;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_private
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT f.*, $1, '/'::VARCHAR, TRUE, NULL::shared_folder_membership_role
        FROM filesystem f WHERE owner_id = $1 AND type = 'PRIVATE' AND state = 'ACTIVE';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_private_one
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint, OUT filesystem filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem f WHERE f.fs_id = $1 AND state = 'ACTIVE'::filesystem_state
        AND type = 'PRIVATE'::filesystem_type INTO filesystem;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_rlock
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint, OUT filesystem filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem f
        WHERE f.fs_id = $1 AND state &lt;&gt; 'DELETED'::filesystem_state FOR SHARE NOWAIT
        INTO filesystem;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_lookup_user_private_one
Schema: pod
Result Data Type: filesystem
Argument Data Types: userid bigint, OUT filesystem filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem f WHERE f.owner_id = $1 AND state = 'ACTIVE'::filesystem_state
        AND type = 'PRIVATE'::filesystem_type INTO filesystem;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_mark_inactive
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET sum_file_size = 0, file_count = 0, dir_count = 0, conflict_count = 0,
        state = 'INACTIVE'::filesystem_state, joined_count = 0, invited_count = 0,
        inactive_time = statement_timestamp()
        WHERE fs_id = $1 RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_owned_id_list
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: userid bigint
Volatility: stable
Language: sql
Source Code:

    SELECT fs_id FROM filesystem
        WHERE owner_id = $1 AND state &lt;&gt; 'DELETED'::filesystem_state ORDER BY type, fs_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_owned_list
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: userid bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE owner_id = $1 AND state &lt;&gt; 'DELETED'::filesystem_state ORDER BY type, fs_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_recover
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    updated BOOLEAN := FALSE;
    fs_ctid RECORD;
    new_rec_ver BIGINT;
    fs_schema_name VARCHAR;
    schema_exists BOOLEAN;
BEGIN
    FOR fs_ctid IN SELECT *, CTID FROM filesystem
            WHERE state &lt;&gt; 'DELETED'::filesystem_state AND recovered_version IS NULL LIMIT 1000 LOOP
        new_rec_ver := fs_ctid.xid + 1;
        UPDATE filesystem SET recovered_version = new_rec_ver WHERE CTID = fs_ctid.CTID;

        fs_schema_name := fsid_to_schema(fs_ctid.fs_id);
        schema_exists := does_schema_exist(fs_schema_name);
        IF schema_exists THEN
            EXECUTE $q$ SELECT setval($1, $2) $q$
                USING fs_schema_name || '.version_id_seq', new_rec_ver;
        END IF;
    END LOOP;
    RETURN new_rec_ver IS NOT NULL;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_recover_reset
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET recovered_version = NULL WHERE recovered_version IS NOT NULL;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_space_used_by
Schema: pod
Result Data Type: numeric
Argument Data Types: owner_id bigint, include_versions boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    tmp_space NUMERIC;
    space NUMERIC;
BEGIN
    IF include_versions THEN
        space := 0;
        FOR fs IN SELECT * FROM filesystem f WHERE state = 'ACTIVE' AND f.owner_id = filesystem_space_used_by.owner_id ORDER BY fs_id LOOP
            PERFORM set_path_read_fs(fs.fs_id);
            EXECUTE $q$ SELECT * FROM file_total_used_space() $q$ INTO tmp_space;
            space := space + tmp_space;
        END LOOP; 
    ELSE
        SELECT SUM(sum_file_size) FROM filesystem f WHERE f.owner_id = $1 
            AND f.type &lt;&gt; 'TEAM'::filesystem_type INTO space;
    END IF;
    RETURN space;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_subtype_cifs_dynamic
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '16777216'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_subtype_cifs_static
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '8388608'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_subtype_edp
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '25165824'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_subtype_share
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '0'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_subtype_team
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '33554432'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_total_storage_used
Schema: pod
Result Data Type: numeric
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT coalesce(sum(sum_file_size), 0) FROM filesystem WHERE state = 'ACTIVE';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_totals_for_owner
Schema: pod
Result Data Type: record
Argument Data Types: INOUT owner_id bigint, OUT file_count numeric, OUT sum_file_size numeric, OUT dir_count numeric, OUT conflict_count numeric
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT $1, SUM(f.file_count), SUM(f.sum_file_size), SUM(f.dir_count), filesystem_conflict_total_for_user($1)
        FROM filesystem f WHERE f.owner_id = $1 AND f.type &lt;&gt; 'TEAM'::filesystem_type
        INTO owner_id, file_count, sum_file_size, dir_count, conflict_count;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_update_conflicts
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, conflict_change bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT filesystem_update_stats($1, 0, 0, 0, $2, $3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_update_extended_prune_values
Schema: pod
Result Data Type: void
Argument Data Types: filesystem_id bigint, daily timestamp with time zone, weekly timestamp with time zone, monthly timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem
      SET earliest_daily_version = GREATEST(earliest_daily_version, $2),
          earliest_weekly_version = GREATEST(earliest_weekly_version, $3),
          earliest_monthly_version = GREATEST(earliest_monthly_version, $4)
      WHERE fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_update_prune_values
Schema: pod
Result Data Type: void
Argument Data Types: filesystem_id bigint, age_prune boolean, max_version_prune integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET age_prune = $2, max_version_prune = $3 WHERE fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: filesystem_update_stats
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, file_count bigint, size bigint, dir_count bigint, conflict_change bigint, xid bigint, check_limits boolean DEFAULT true
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, $6::TEXT);

    UPDATE filesystem f SET file_count = f.file_count + $2, sum_file_size = f.sum_file_size + $3,
        dir_count = f.dir_count + $4, conflict_count = f.conflict_count + $5, xid = $6
    WHERE f.fs_id = $1 AND ($7 = FALSE OR (
        ($2 + $4 &lt;= 0 OR CASE
                           WHEN f.type IN ('PRIVATE', 'SHARED') THEN
                               limit_entries(f.fs_id, owner_file_count(f.fs_id) + $2 + $4)
                           WHEN f.type IN ('TEAM', 'EDP') THEN
                               limit_entries(f.fs_id, filesystem_file_count(f.fs_id) + $2 + $4)
                           END )
        AND ($3 &lt; 0 OR ($3 = 0 AND $2 &lt;= 0) OR assert_under_quota($1, $3))));
    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: find_user_filesystems_with_label
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: label character varying, user_id bigint, VARIADIC states filesystem_state[]
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM filesystem as fs where fs.label = $1 AND fs.owner_id = $2
        AND fs.state = ANY($3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_func_schema
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 'fs_func_v'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_func_schema_set
Schema: pod
Result Data Type: void
Argument Data Types: version bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE 'SET SEARCH_PATH TO ' || fs_func_schema() || version || ','
        || fsid_to_schema(version) || ',pod,public';
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_edp
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint
Volatility: immutable
Language: sql
Source Code:

    SELECT fs_is_edp(fs.type) FROM filesystem fs WHERE fs.fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_edp
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_type filesystem_type
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 = 'EDP'::filesystem_type;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_inactive
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint
Volatility: immutable
Language: sql
Source Code:

    SELECT fs_is_inactive(fs.state) FROM filesystem fs WHERE fs.fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_inactive
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_state filesystem_state
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 IS NOT NULL AND $1 = 'INACTIVE'::filesystem_state;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_mobilized
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint
Volatility: immutable
Language: sql
Source Code:

    SELECT fs_is_mobilized(fs.type) FROM filesystem fs WHERE fs.fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_mobilized
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_type filesystem_type
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 in ('CIFS_STATIC'::filesystem_type, 'CIFS_DYNAMIC'::filesystem_type);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_is_private
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_type filesystem_type
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 IS NOT NULL AND $1 = 'PRIVATE'::filesystem_type;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_next_cifs_dynamic_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT resource_type_filesystem_not_user_based() | filesystem_subtype_cifs_dynamic() 
        | nextval('fs_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_next_cifs_static_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT resource_type_filesystem_not_user_based() | filesystem_subtype_cifs_static() 
        | nextval('fs_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_next_edp_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT resource_type_filesystem_not_user_based() | filesystem_subtype_edp() 
        | nextval('fs_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT resource_type_filesystem_not_user_based() | filesystem_subtype_share()
        | nextval('fs_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_next_team_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT resource_type_filesystem_not_user_based() | filesystem_subtype_team() 
        | nextval('fs_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_optimize_space
Schema: pod
Result Data Type: void
Argument Data Types: fs_id bigint, table_num integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_wlock_fs(fs_id);
    EXECUTE $q$ SELECT * FROM optimize_space($1) $q$ USING table_num;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_version_latest
Schema: pod
Result Data Type: integer
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

            SELECT '120'::integer;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fs_version_target
Schema: pod
Result Data Type: integer
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

            SELECT '120'::integer;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: fsid_to_schema
Schema: pod
Result Data Type: character varying
Argument Data Types: fs_id bigint
Volatility: immutable
Language: c
Source Code:
fsid_to_schema
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: full_path
Schema: pod
Result Data Type: character varying
Argument Data Types: parent character varying, filename character varying
Volatility: immutable
Language: c
Source Code:
full_path
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: function_exist
Schema: pod
Result Data Type: boolean
Argument Data Types: name text
Volatility: stable
Language: sql
Source Code:

    SELECT EXISTS(SELECT proname FROM pg_catalog.pg_proc WHERE proname = $1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: get_edp_count
Schema: pod
Result Data Type: bigint
Argument Data Types: is_client_id_null boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT count(*) FROM filesystem fs 
	    WHERE fs_is_edp(fs.type) AND fs.state = 'ACTIVE'::filesystem_state
	        AND fs.client_id IS NULL = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: get_extended_upgrade_failures
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE upgrade_attempts IS NOT NULL AND upgrade_attempts &gt;= get_max_fs_upgrade_attempts_config();

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: get_limit
Schema: pod
Result Data Type: character varying
Argument Data Types: limit_name character varying, OUT result character varying
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $q$ SELECT $q$ || quote_ident(limit_name) || $q$::VARCHAR FROM limits $q$ INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: get_max_fs_upgrade_attempts_config
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT CAST(value AS BIGINT) from pod_config_lookup('max.fs.upgrade.attempts');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: get_object_client_stats
Schema: pod
Result Data Type: SETOF record
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fsid BIGINT;
BEGIN
FOR fsid IN SELECT fs_id FROM filesystem WHERE state = 'ACTIVE'::filesystem_state LOOP
   PERFORM set_path_read_fs(fsid);
   RETURN QUERY EXECUTE $q$
       SELECT v.client_id, COUNT(v.entry_id), v.operating_system, v.user_id
       FROM (
           SELECT DISTINCT version.client_id, entry_id, operating_system, client.user_id
           FROM version, client
           WHERE version.client_id = client.client_id
       ) v GROUP BY v.client_id, v.operating_system, v.user_id; $q$;
END LOOP;
RETURN;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: has_exceeded_team_folder_quota
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id_in bigint, size numeric
Volatility: stable
Language: sql
Source Code:

    SELECT TRUE FROM team_folder WHERE fs_id = $1 AND quota &lt; $2;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: has_exceeded_user_quota
Schema: pod
Result Data Type: boolean
Argument Data Types: user_id bigint, size numeric
Volatility: stable
Language: sql
Source Code:

    SELECT TRUE FROM user_account WHERE user_id = $1 AND effective_quota &lt; $2;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hash
Schema: pod
Result Data Type: integer
Argument Data Types: bigint, bytea
Volatility: immutable
Language: c
Source Code:
hash_bigint_bytea
Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hash
Schema: pod
Result Data Type: integer
Argument Data Types: character varying
Volatility: immutable
Language: c
Source Code:
hash_varchar
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_alert_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_alert;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_alert_create
Schema: pod
Result Data Type: SETOF hdi_alert
Argument Data Types: device_id bigint, filesystem_id bigint, filesystem_name character varying, error_code character varying, error_message character varying, system_error_message character varying
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO hdi_alert (device_id, filesystem_id, filesystem_name, error_code, error_message, system_error_message)
    VALUES ($1, $2, $3, $4, $5, $6) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_alert_delete_all
Schema: pod
Result Data Type: boolean
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_alert WHERE device_id = $1;
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_alert_list
Schema: pod
Result Data Type: SETOF hdi_alert
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_alert where device_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_all_filesystems_list
Schema: pod
Result Data Type: SETOF hdi_filesystem_summary
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT id, resource_id, name, type::text, cache_size
        FROM hdi_local_filesystem WHERE resource_id = $1
    UNION
    SELECT id, resource_id, name, 'IMPORTED' AS type, cache_size
        FROM hdi_imported_filesystem WHERE resource_id = $1

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_all_imported_filesystems_list
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_imported_filesystem WHERE resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_all_imported_filesystems_list_with_hcp_info
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem_with_hcp_info
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT f.*, n.name, n.read_only_username, n.read_only_password, n.need_ro_password, t.hostname,
        t.replica_domain, t.public_address, t.replica_public_address
    FROM (hdi_imported_filesystem f LEFT OUTER JOIN namespace n on (n.namespace_id = f.namespace_id))
          LEFT OUTER JOIN tenant t ON (t.tenant_id = n.tenant_id)
    WHERE f.resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_all_local_filesystems_list
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_local_filesystem WHERE resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_all_local_filesystems_list_with_hcp_info
Schema: pod
Result Data Type: SETOF hdi_local_filesystem_with_hcp_info
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT f.*, n.name, n.username, n.password, n.need_password, t.hostname, t.replica_domain,
        t.public_address, t.replica_public_address
    FROM (hdi_local_filesystem f LEFT OUTER JOIN namespace n on (n.namespace_id = f.namespace_id))
          LEFT OUTER JOIN tenant t ON (t.tenant_id = n.tenant_id)
    WHERE f.resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_apply_template
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: template_id bigint, device_id bigint, network_settings character varying, device_version_id bigint, template_version_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
    SET settings_api_version = source.settings_api_version,
        tenant_id = source.tenant_id,
        network_settings = $3,
        time_settings = source.time_settings,
        authentication_settings = source.authentication_settings,
        services_settings = source.services_settings,
        cifs_enabled = source.cifs_enabled,
        nfs_enabled = source.nfs_enabled,
        reporting_interval_minutes = source.reporting_interval_minutes,
        proxy_settings = source.proxy_settings,
        version_id = hdi_config_next_version(version_id),
        use_tenant_public_address = source.use_tenant_public_address,
        enable_encryption_at_rest = source.enable_encryption_at_rest,
        last_change_time = now()
        FROM (SELECT settings_api_version, tenant_id, time_settings, authentication_settings,
                  services_settings, cifs_enabled, nfs_enabled,  reporting_interval_minutes, proxy_settings,
                  use_tenant_public_address, enable_encryption_at_rest
              FROM hdi_config WHERE resource_id = $1 AND version_id = $5) source
        WHERE resource_id = $2 AND version_id = $4 RETURNING hdi_config.*;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_copy_configuration
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: source_id bigint, target_id bigint, target_version_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
    SET settings_api_version = source.settings_api_version,
        tenant_id = source.tenant_id,
        network_settings = source.network_settings,
        time_settings = source.time_settings,
        authentication_settings = source.authentication_settings,
        services_settings = source.services_settings,
        cifs_enabled = source.cifs_enabled,
        nfs_enabled = source.nfs_enabled,
        reporting_interval_minutes = source.reporting_interval_minutes,
        proxy_settings = source.proxy_settings,
        version_id = hdi_config_next_version(version_id),
        use_tenant_public_address = source.use_tenant_public_address,
        enable_encryption_at_rest = source.enable_encryption_at_rest,
        last_change_time = now()
        FROM (SELECT settings_api_version, tenant_id, network_settings, time_settings, authentication_settings,
                  services_settings, cifs_enabled, nfs_enabled,
                  reporting_interval_minutes, proxy_settings, use_tenant_public_address, enable_encryption_at_rest
                FROM hdi_config where resource_id = $1) source
        WHERE resource_id = $2 AND version_id = $3 RETURNING hdi_config.*;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_create
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, owner_type hdi_config_owner_type
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO hdi_config(resource_id, owner_type, version_id, last_change_time) VALUES
        ($1, $2, 1, now()) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_delete
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_config
      WHERE resource_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_force_update_config_version
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_lock
Schema: pod
Result Data Type: hdi_config_lock
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_config_lock FOR UPDATE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_lookup_by_id
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_config where resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_next_version
Schema: pod
Result Data Type: bigint
Argument Data Types: current_version bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT $1 + 1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_authentication_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, authentication_settings character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, authentication_settings = $4, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_config_and_api_versions
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_config_version
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_encryption_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, enable_encryption_at_rest boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, enable_encryption_at_rest = $4, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_network_and_proxy_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, network_settings character varying, proxy_settings character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, network_settings = $4, proxy_settings = $5, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_reporting_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, reporting_interval_minutes integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, reporting_interval_minutes = $4, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_services_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, services_settings character varying, cifs_enabled boolean, nfs_enabled boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, services_settings = $4, cifs_enabled = $5, nfs_enabled = $6,
            version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, tenant_id bigint, network_settings character varying, time_settings character varying, authentication_settings character varying, services_settings character varying, cifs_enabled boolean, nfs_enabled boolean, reporting_interval_minutes integer, proxy_settings character varying, use_tenant_public_address boolean, enable_encryption_at_rest boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config SET settings_api_version = $3, tenant_id = $4, network_settings = $5, time_settings = $6,
        authentication_settings = $7, services_settings = $8, cifs_enabled = $9, nfs_enabled = $10,
        reporting_interval_minutes = $11, proxy_settings = $12, use_tenant_public_address = $13, enable_encryption_at_rest = $14,
        version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_tenant
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, tenant_id bigint, use_tenant_public_address boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET tenant_id = (SELECT tenant_id FROM tenant WHERE tenant_id = $3), use_tenant_public_address = $4,
            version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_config_update_time_settings
Schema: pod
Result Data Type: SETOF hdi_config
Argument Data Types: resource_id bigint, version_id bigint, settings_api_version character varying, time_settings character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET settings_api_version = $3, time_settings = $4, version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id = $1 AND version_id = $2 AND (settings_api_version = $3 OR settings_api_version is null) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_clear_temp_password
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET temp_password = null, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_count_all_but_deleted
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_device WHERE state &lt;&gt; 'DELETED';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_count_all_in_service
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_device WHERE is_in_service(state);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_count_expired_health_report
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_device WHERE is_in_service(state) AND health_report_expiration_date &lt;= now();

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_count_filtered
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: tab hdi_tab, primary_filter hdi_device_primary_filter, filter_by_value character varying, secondary_filter hdi_device_secondary_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dest_where_clause VARCHAR;
    dest_where_arg VARCHAR;
    dest_from_tables VARCHAR;
    query_str VARCHAR;
BEGIN

    SELECT from_tables FROM hdi_device_list_from_tables(primary_filter, filter_by_value) INTO dest_from_tables;

    SELECT where_clause, where_arg
       FROM hdi_device_list_filtered_where_clause(tab, primary_filter, filter_by_value, secondary_filter)
       INTO dest_where_clause, dest_where_arg;

    query_str := 'SELECT COUNT(DISTINCT d.*) FROM ' || dest_from_tables;
    IF length(dest_where_clause) &gt; 0 THEN
        query_str := query_str || ' WHERE ' || dest_where_clause ;
    END IF;
    --RAISE notice 'Executing:  % USING %', query_str, dest_where_arg;
    RETURN QUERY EXECUTE query_str USING dest_where_arg;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_counts_filtered
Schema: pod
Result Data Type: record
Argument Data Types: primary_filter hdi_device_primary_filter, filter_by_value character varying, OUT inventory_count bigint, OUT in_service_count bigint, OUT out_of_service_count bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dest_where_clause VARCHAR;
    dest_where_arg VARCHAR;
    dest_from_tables VARCHAR;
    query_str VARCHAR;
    device_state hdi_device_state;
    device_count BIGINT;
BEGIN
    inventory_count := 0;
    in_service_count := 0;
    out_of_service_count := 0;

    SELECT from_tables FROM hdi_device_list_from_tables(primary_filter, filter_by_value) INTO dest_from_tables;

    SELECT where_clause, where_arg
       FROM hdi_device_list_filtered_where_clause(NULL::hdi_tab, primary_filter, filter_by_value, 'ALL'::hdi_device_secondary_filter)
       INTO dest_where_clause, dest_where_arg;

    query_str := 'SELECT state, COUNT(DISTINCT d.*) FROM ' || dest_from_tables;
    IF length(dest_where_clause) &gt; 0 THEN
        query_str := query_str || ' WHERE ' || dest_where_clause ;
    END IF;
    query_str := query_str || ' GROUP BY state';
    --RAISE notice 'Executing:  % USING %', query_str, dest_where_arg;

    FOR device_state, device_count IN EXECUTE query_str USING dest_where_arg LOOP
        IF is_pre_service(device_state) THEN
            inventory_count := inventory_count + device_count;
        ELSIF is_in_service(device_state) THEN
            in_service_count := in_service_count + device_count;
        ELSIF is_decommissioned(device_state) THEN
            out_of_service_count := out_of_service_count + device_count;
        END IF;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_create
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: serial_number character varying, state hdi_device_state, name character varying, description character varying, model character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    model_number hdi_model_number;
    result hdi_device;
BEGIN
    model_number := hdi_model_number_lookup(model);
    IF model_number.model_number IS NULL THEN
        RAISE EXCEPTION 'HDI MODEL NUMBER NOT FOUND';
    END IF;
    INSERT INTO hdi_device(device_id, serial_number, state, name, description, model, total_cache, xid)
        (SELECT hdi_device_next_id, $1, $2, $3, $4, model_number.model_number, model_number.cache_size, xid_next(hdi_device_next_id)
            FROM hdi_device_next_id()) RETURNING * INTO result;

    PERFORM limit_hdi_devices_not_deleted(hdi_device_count_all_but_deleted());

    RETURN NEXT result;
EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI DEVICE CONFLICT';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_decommission
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'DECOMMISSIONED', xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_delete
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'DELETED', xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND NOT is_in_service(state) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_expire_health_report
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: dev_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET health_report_expiration_date = now() WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_has_in_service_device
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT * FROM hdi_device WHERE is_in_service(state) LIMIT 1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_importable_count
Schema: pod
Result Data Type: bigint
Argument Data Types: importing_resource bigint, filter hdi_device_primary_filter, filter_value character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR;
    result BIGINT;
BEGIN
    qry := $q$ SELECT COUNT(DISTINCT serial_number) FROM hdi_device d, hdi_local_filesystem fs $q$;
    IF filter IS NOT NULL AND filter = 'TAG' AND filter_value IS NOT NULL AND length(filter_value) &gt; 0 THEN
        qry := qry || ', hdi_tag_assoc a, hdi_tag t ';
    END IF;
    qry := qry || 'WHERE ' || hdi_device_importable_where_clause(filter, filter_value);
    EXECUTE qry USING filter_value, importing_resource INTO result;
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_importable_list
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: importing_resource bigint, filter hdi_device_primary_filter, filter_value character varying, max_count bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR;
BEGIN
    qry := $q$ SELECT DISTINCT d.* FROM hdi_device d, hdi_local_filesystem fs $q$;
    IF filter IS NOT NULL AND filter = 'TAG' AND filter_value IS NOT NULL AND length(filter_value) &gt; 0 THEN
        qry := qry || ', hdi_tag_assoc a, hdi_tag t ';
    END IF;
    qry := qry || 'WHERE ' || hdi_device_importable_where_clause(filter, filter_value) ||
        $q$ ORDER BY serial_number LIMIT $3 $q$;
    RETURN QUERY EXECUTE qry USING filter_value, importing_resource, max_count;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_importable_where_clause
Schema: pod
Result Data Type: character varying
Argument Data Types: filter hdi_device_primary_filter, filter_value character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR := '';
BEGIN
    IF filter IS NOT NULL AND filter_value IS NOT NULL AND length(filter_value) &gt; 0 THEN
        IF filter = 'SERIAL_NUMBER' THEN
            qry := $q$ normalize(d.serial_number) LIKE normalize($1) || '%' AND $q$;
        ELSIF filter = 'NAME' THEN
            qry := $q$ normalize(d.name) LIKE normalize($1) || '%' AND $q$;
        ELSIF filter = 'TAG' THEN
            qry := 'd.device_id = a.resource_id AND ' ||
              $q$ a.tag_id = t.tag_id AND normalize(t.tag) LIKE normalize($1) || '%' AND $q$;
        END IF;
    END IF;
    RETURN qry || $q$ is_in_service(d.state) AND d.device_id &lt;&gt; $2 $q$ ||
        $q$ AND d.device_id = fs.resource_id AND fs.type = 'EXPORTED' $q$;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_inventory_report
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: order_by_column hdi_device_inventory_report_sort_column, is_descending boolean, limit_cnt bigint, offset_cnt bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sort_direction VARCHAR := 'ASC';
    query_str VARCHAR;
BEGIN

    IF is_descending THEN
        sort_direction := 'DESC';
    END IF;

    query_str := $a$ SELECT * FROM hdi_device WHERE state &lt;&gt; 'DELETED'
        ORDER BY $a$ || order_by_column || ' ' || sort_direction  || '
        LIMIT ' || limit_cnt || ' OFFSET ' || offset_cnt ;
    --RAISE notice 'Executing:  %', query_str;
    RETURN QUERY EXECUTE query_str;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_inventory_report_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_device WHERE state &lt;&gt; 'DELETED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_list_filtered_sorted_paged
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: tab hdi_tab, primary_filter hdi_device_primary_filter, filter_by_value character varying, secondary_filter hdi_device_secondary_filter, order_by_column hdi_device_sort_column, is_descending boolean, limit_cnt bigint, offset_cnt bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sort_direction VARCHAR := 'ASC';
    query_str VARCHAR;
    dest_where_clause VARCHAR;
    dest_where_arg VARCHAR;
    dest_from_tables VARCHAR;
BEGIN

    IF is_descending THEN
        sort_direction := 'DESC';
    END IF;

    SELECT from_tables FROM hdi_device_list_from_tables(primary_filter, filter_by_value) INTO dest_from_tables;

    SELECT where_clause, where_arg
       FROM hdi_device_list_filtered_where_clause(tab, primary_filter, filter_by_value, secondary_filter)
       INTO dest_where_clause, dest_where_arg;

    query_str := 'SELECT DISTINCT d.* FROM ' || dest_from_tables;
    IF length(dest_where_clause) &gt; 0 THEN
        query_str := query_str || ' WHERE ' || dest_where_clause;
    END IF;
    IF order_by_column IS NOT NULL THEN
        query_str := query_str || ' ORDER BY ' || order_by_column || ' ' || sort_direction;
    END IF;
    query_str := query_str || ' LIMIT ' || limit_cnt || ' OFFSET ' || offset_cnt ;
    --RAISE notice 'Executing:  % USING %', query_str, dest_where_arg;
    RETURN QUERY EXECUTE query_str USING dest_where_arg;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_list_filtered_where_clause
Schema: pod
Result Data Type: record
Argument Data Types: tab hdi_tab, primary_filter hdi_device_primary_filter, filter_by_value character varying, secondary_filter hdi_device_secondary_filter, OUT where_clause character varying, OUT where_arg character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    tab_selection VARCHAR := '';
    filter_str VARCHAR := '';
    secondary_filter_str VARCHAR := '';
BEGIN

    where_clause := '';

    -- if filter value is null or empty, short circuit primary filter processing
    IF filter_by_value IS NULL OR length(filter_by_value) = 0 THEN
        primary_filter := NULL;
    END IF;
    
    -- primary filter processing
    IF primary_filter IS NOT NULL THEN
        IF primary_filter = 'SERIAL_NUMBER' THEN
            where_clause := 'normalize(serial_number) LIKE normalize($1) AND ';
            where_arg := filter_by_value || '%';
        ELSIF primary_filter = 'NAME' THEN
            where_clause := 'normalize(name) LIKE normalize($1) AND ';
            where_arg := filter_by_value || '%';
        ELSIF primary_filter = 'STATE' THEN
            IF filter_by_value = 'READY' THEN
                where_clause := 'is_ready(state) AND ';
            ELSE
                where_clause := 'state = $1::hdi_device_state AND ';
                where_arg := filter_by_value;
            END IF;
        ELSIF primary_filter = 'TAG' THEN
            where_clause := 'd.device_id = a.resource_id AND ' ||
              ' a.tag_id = t.tag_id AND normalize(t.tag) LIKE normalize($1) AND ';
            where_arg := filter_by_value || '%';
        END IF;
    END IF;

    IF secondary_filter IS NOT NULL AND secondary_filter != 'ALL' THEN
        IF secondary_filter = 'WITH_ALERTS' THEN
            where_clause := where_clause ||
                $q$ (is_device_alert OR is_protocol_alert OR is_missing_namespace_alert $q$ ||
                $q$ OR namespace_quota_alert_level &lt;&gt; 'NONE' OR health_report_expiration_date &lt;= now()) AND $q$;
        ELSIF secondary_filter = 'SUSPENDED' THEN
            where_clause := where_clause || ' is_suspended AND ';
        END IF;
    END IF;

    IF tab = 'INVENTORY' THEN
        where_clause := where_clause || ' is_pre_service(state)';
    ELSIF tab = 'IN_SERVICE' THEN
        where_clause := where_clause || ' is_in_service(state)';
    ELSIF tab = 'OUT_OF_SERVICE' THEN
        where_clause := where_clause || ' is_decommissioned(state)';
    ELSE
        where_clause := where_clause || $q$ state &lt;&gt; 'DELETED' $q$;
    END IF;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_list_from_tables
Schema: pod
Result Data Type: character varying
Argument Data Types: primary_filter hdi_device_primary_filter, filter_by_value character varying, OUT from_tables character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    from_tables := 'hdi_device d';
    IF primary_filter IS NOT NULL AND primary_filter = 'TAG' AND
            filter_by_value IS NOT NULL AND length(filter_by_value) &gt; 0 THEN
        from_tables := from_tables || ', hdi_tag_assoc a, hdi_tag t';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_all_decommissioned
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where is_decommissioned(state);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_all_in_service
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where is_in_service(state);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_all_preservice
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where is_pre_service(state);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_all_with_system_alert
Schema: pod
Result Data Type: SETOF hdi_device_alert
Argument Data Types: max_records bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT (d).*, a.filesystem_id, a.filesystem_name, a.error_code, a.error_message, a.system_error_message
    FROM hdi_device d, hdi_alert a
    WHERE d.device_id = a.device_id AND a.system_error_message IS NOT NULL ORDER BY d.device_id LIMIT $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_by_id
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where device_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_by_name
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: name character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where name = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_by_name_starts_with
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: name_prefix character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where name LIKE $1 || '%';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_by_sn
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: serial_number character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device where serial_number = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_by_sn_not_deleted
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: serial_number character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_device WHERE serial_number = $1 AND state &lt;&gt; 'DELETED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_lookup_config_info
Schema: pod
Result Data Type: SETOF hdi_device_config_info
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT d.device_id AS device_id, d.serial_number AS serial_number, d.state AS device_state, d.xid AS device_xid,
        c.version_id AS config_version, c.tenant_id AS tenant_id FROM hdi_device d, hdi_config c
     WHERE d.device_id = $1 AND d.xid = $2 AND d.device_id = c.resource_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_metrics_count
Schema: pod
Result Data Type: record
Argument Data Types: OUT total bigint, OUT inventory bigint, OUT in_service bigint, OUT out_service bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    dev_state hdi_device_state;
BEGIN
    total := 0;
    inventory := 0;
    in_service := 0;
    out_service := 0;
    FOR dev_state IN SELECT state FROM hdi_device WHERE state &lt;&gt; 'DELETED' LOOP
        total := total + 1;
        IF is_in_service(dev_state) THEN
            in_service := in_service + 1;
        ELSIF is_pre_service(dev_state) THEN
            inventory := inventory + 1;
        ELSIF is_decommissioned(dev_state) THEN
            out_service := out_service + 1;
        END IF;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_device_id_seq') | resource_type_hdi_device();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_put_in_service
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: id bigint, device_xid bigint, device_temp_password character varying, device_is_replacement boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT limit_hdi_devices_licensed(hdi_device_count_all_in_service() + 1);
    SELECT hdi_validate_ten_public_addr_config($1);

    UPDATE hdi_device SET state = 'READY', temp_password = $3, perm_password = null, is_suspended = FALSE,
            is_replacement = $4, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND state = 'RESERVED' RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_remove_reservation
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'AVAILABLE', name = null, description = null, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND state = 'RESERVED' RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_replacement_count
Schema: pod
Result Data Type: bigint
Argument Data Types: filter hdi_device_primary_filter, filter_value character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR;
    result BIGINT;
BEGIN
    qry := $q$ SELECT COUNT(*) FROM hdi_device WHERE $q$ ||
        hdi_device_replacement_where_clause(filter, filter_value);
    EXECUTE qry USING filter_value INTO result;
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_replacement_list
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: filter hdi_device_primary_filter, filter_value character varying, max_count bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR;
BEGIN
    qry := $q$ SELECT * FROM hdi_device WHERE $q$ ||
        hdi_device_replacement_where_clause(filter, filter_value) ||
        $q$ ORDER BY serial_number LIMIT $2 $q$;
    RETURN QUERY EXECUTE qry USING filter_value, max_count;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_replacement_where_clause
Schema: pod
Result Data Type: character varying
Argument Data Types: filter hdi_device_primary_filter, filter_value character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    qry VARCHAR := '';
BEGIN
    IF filter IS NOT NULL AND filter_value IS NOT NULL AND length(filter_value) &gt; 0 THEN
        IF filter = 'SERIAL_NUMBER' THEN
            qry := $q$ normalize(serial_number) LIKE normalize($1) || '%' AND $q$;
        END IF;
    END IF;
    RETURN qry || $q$ state = 'AVAILABLE' $q$;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_reserve
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'RESERVED', xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND state = 'AVAILABLE' RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_resume_with_password_reset
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, temp_password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET is_suspended = FALSE, temp_password = $3, perm_password = null, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND is_in_service(state) AND is_suspended = TRUE RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_resume_without_password_reset
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET is_suspended = FALSE, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND is_in_service(state) AND is_suspended = TRUE RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_schedule_namespace_creation
Schema: pod
Result Data Type: void
Argument Data Types: resource_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result hdi_device;
BEGIN
    UPDATE hdi_device SET is_missing_namespace_alert = TRUE
        WHERE device_id = resource_id AND is_in_service(state) RETURNING * INTO result;
    IF result.device_id IS NOT NULL THEN
        PERFORM pgq.insert_event('async_task', 'HDI_DEVICE_NAMESPACE_CREATION', cast(resource_id AS text));
    END IF;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_set_active
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'ACTIVE', xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_set_missing_namespace_alert
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: dev_id bigint, val boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET is_missing_namespace_alert = $2 WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_set_namespace_quota_alert
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: dev_id bigint, alert_level hdi_device_namespace_quota_alert_level
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET namespace_quota_alert_level = $2 WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_set_perm_password
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, perm_password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET perm_password = $3, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_set_provisioning_in_progress
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = 'PROVISIONING_IN_PROGRESS', xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND is_provisioning_allowed(state, is_suspended) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_suspend
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET is_suspended = TRUE, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND is_in_service(state) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_tenant_updated
Schema: pod
Result Data Type: void
Argument Data Types: tenantid bigint, internal_addr_changed boolean, public_addr_changed boolean, is_public_addr_missing boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rid BIGINT;
BEGIN
    IF NOT (internal_addr_changed OR public_addr_changed) THEN
        RETURN;
    END IF;

    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE tenant_id = tenantid AND (internal_addr_changed OR (public_addr_changed AND use_tenant_public_address));
    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id IN
            (SELECT if.resource_id FROM hdi_config lc, hdi_local_filesystem lf, hdi_imported_filesystem if, hdi_config ic
                WHERE lc.tenant_id = tenantid AND lc.resource_id = lf.resource_id AND lf.id = if.exported_filesystem_id
                  AND (internal_addr_changed OR (public_addr_changed AND if.resource_id = ic.resource_id AND ic.use_tenant_public_address)));

    IF public_addr_changed THEN
        -- For some reason, the FOR with UNION below doesn't work, so instead we do two separate loops.
        -- Unfortunately, this means that we could call hdi_device_update_is_tenant_alert() twice for some resource ids
        --FOR rid IN
            --SELECT DISTINCT res_id FROM (
            --    (SELECT resource_id FROM hdi_config WHERE tenant_id = tenantid)
            --    UNION
            --    (SELECT ic.resource_id FROM hdi_config lc, hdi_local_filesystem lf, hdi_imported_filesystem if, hdi_config ic
            --        WHERE lc.tenant_id = tenantid AND lc.resource_id = lf.resource_id AND lf.id = if.exported_filesystem_id
            --          AND if.resource_id = ic.resource_id AND ic.use_tenant_public_address)) AS res_id
        FOR rid IN
            SELECT resource_id FROM hdi_config WHERE tenant_id = tenantid
        LOOP
            PERFORM hdi_device_update_is_tenant_alert(rid);
        END LOOP;
        FOR rid IN
            SELECT ic.resource_id FROM hdi_config lc, hdi_local_filesystem lf, hdi_imported_filesystem if, hdi_config ic
                WHERE lc.tenant_id = tenantid AND lc.resource_id = lf.resource_id AND lf.id = if.exported_filesystem_id
                  AND if.resource_id = ic.resource_id AND ic.use_tenant_public_address
        LOOP
            PERFORM hdi_device_update_is_tenant_alert(rid);
        END LOOP;
    END IF;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, state hdi_device_state, name character varying, description character varying, model character varying, total_cache bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET state = $3, name = $4, description = $5, model = $6, total_cache = $7,
            xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_description
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, description character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET description = $3, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_general_settings
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, name character varying, description character varying, cache_size bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET name = $3, description = $4, total_cache = $5, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_is_device_alert
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, is_alert boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET is_device_alert = $2  WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_is_missing_namespace_alert
Schema: pod
Result Data Type: boolean
Argument Data Types: dev_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    cnt BIGINT;
    result hdi_device;
BEGIN
    SELECT COUNT(*) FROM hdi_local_filesystem WHERE resource_id = dev_id AND namespace_id IS NULL INTO cnt;
    UPDATE hdi_device SET is_missing_namespace_alert = (is_in_service(state) AND cnt &gt; 0)
        WHERE device_id = dev_id
        RETURNING * INTO result;
    IF result.device_id IS NOT NULL THEN
        return result.is_missing_namespace_alert;
    END IF;

    RETURN NULL;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_is_protocol_alert
Schema: pod
Result Data Type: boolean
Argument Data Types: dev_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    config hdi_config;
    cnt BIGINT;
    is_alert BOOLEAN := FALSE;
BEGIN
    SELECT * FROM hdi_config WHERE resource_id = dev_id INTO config;

    -- could be a template, not a device
    IF config.resource_id IS NOT NULL THEN
        IF config.cifs_enabled AND config.nfs_enabled THEN
            is_alert := FALSE;
        ELSE
            SELECT hdi_filesystem_share_get_count_with_protocol(dev_id, 'BOTH') INTO cnt;
            IF cnt &gt; 0 AND (NOT config.cifs_enabled OR NOT config.nfs_enabled) THEN
                is_alert := TRUE;
            ELSE
                IF NOT config.cifs_enabled THEN
                    SELECT hdi_filesystem_share_get_count_with_protocol(dev_id, 'CIFS') INTO cnt;
                    IF cnt &gt; 0 THEN
                        is_alert := TRUE;
                    END IF;
                END IF;
                IF NOT is_alert AND NOT config.nfs_enabled THEN
                    SELECT hdi_filesystem_share_get_count_with_protocol(dev_id, 'NFS') INTO cnt;
                    IF cnt &gt; 0 THEN
                        is_alert := TRUE;
                    END IF;
                END IF;
            END IF;
        END IF;

        UPDATE hdi_device SET is_protocol_alert = is_alert  WHERE device_id = dev_id;
    END IF;

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_is_tenant_alert
Schema: pod
Result Data Type: boolean
Argument Data Types: dev_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    config hdi_config;
    is_alert BOOLEAN := FALSE;
BEGIN
    -- only consider devices, not templates
    SELECT c.* FROM hdi_config c, hdi_device d WHERE c.resource_id = d.device_id AND d.device_id = dev_id INTO config;

    IF config.resource_id IS NOT NULL THEN
        is_alert := hdi_is_ten_public_addr_misconfigured(config);
        UPDATE hdi_device SET is_tenant_alert = is_alert WHERE device_id = dev_id;
    END IF;

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_last_health_report_time
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: dev_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device
        SET last_health_report_time = now(),
            health_report_expiration_date = now() + ((source.reporting_interval_minutes * 3) || ' minutes')::interval
        FROM (SELECT reporting_interval_minutes FROM hdi_config WHERE resource_id = $1) source
        WHERE device_id = $1 RETURNING hdi_device.*;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_name
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, name character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET name = $3, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_namespace_quota_alert_level
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: low_quota_percent bigint, high_quota_percent bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dev_id BIGINT;
    dev_alert_level hdi_device_namespace_quota_alert_level;
    max_used INT;
    new_alert_level hdi_device_namespace_quota_alert_level := 'NONE';
    updated_device hdi_device;
BEGIN
    FOR dev_id, dev_alert_level, max_used IN
        SELECT d.device_id, d.namespace_quota_alert_level, MAX(n.percent_used)
        FROM hdi_device d, hdi_local_filesystem f, namespace n
        WHERE d.device_id = f.resource_id AND f.namespace_id = n.namespace_id GROUP BY d.device_id LOOP

        IF max_used &gt;= high_quota_percent THEN
            new_alert_level := 'HIGH';
        ELSIF max_used &gt;= low_quota_percent THEN
            new_alert_level := 'LOW';
        ELSE
            new_alert_level := 'NONE';
        END IF;

        UPDATE hdi_device SET namespace_quota_alert_level = new_alert_level
            WHERE device_id = dev_id AND namespace_quota_alert_level &lt;&gt; new_alert_level RETURNING * INTO updated_device;
        IF updated_device.device_id IS NOT NULL THEN
            RETURN NEXT updated_device;
        END IF;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_device_update_temp_password
Schema: pod
Result Data Type: SETOF hdi_device
Argument Data Types: device_id bigint, xid bigint, temp_password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_device SET temp_password = $3, xid = xid_next($1)
        WHERE device_id = $1 AND xid = $2 AND temp_password IS NOT null AND is_in_service(state) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_exported_filesystems_list
Schema: pod
Result Data Type: SETOF hdi_filesystem_summary
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT id, resource_id, name, type::text, cache_size
        FROM hdi_local_filesystem WHERE resource_id = $1 AND type = 'EXPORTED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_copy_filesystems
Schema: pod
Result Data Type: boolean
Argument Data Types: source_resource_id bigint, target_resource_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    source_fs_id BIGINT;
    new_local_fs hdi_local_filesystem;
    new_imported_fs hdi_imported_filesystem;
BEGIN
    -- copy local filesystems and shares
    FOR source_fs_id IN SELECT id FROM hdi_local_filesystem WHERE resource_id = source_resource_id LOOP
        INSERT INTO hdi_local_filesystem (id, resource_id, type, name, normalized_name, cache_size,
                    settings_api_version, hcp_versioning_days_to_keep, settings)
            (SELECT hdi_filesystem_next_id(), target_resource_id, type, name, normalized_name, cache_size,
                    settings_api_version, hcp_versioning_days_to_keep, settings
                FROM hdi_local_filesystem WHERE id = source_fs_id)
            RETURNING * INTO new_local_fs;

        INSERT INTO hdi_local_filesystem_share (id, resource_id, filesystem_id, name, normalized_name, protocols)
            (SELECT hdi_filesystem_share_next_id(), target_resource_id, new_local_fs.id, name, normalized_name, protocols
                FROM hdi_local_filesystem_share WHERE filesystem_id = source_fs_id);
    END LOOP;

    -- copy imported filesystems and shares
    FOR source_fs_id IN SELECT id FROM hdi_imported_filesystem WHERE resource_id = source_resource_id LOOP
        INSERT INTO hdi_imported_filesystem
            (id, resource_id, exported_filesystem_id, name, normalized_name, cache_size, namespace_id)
            (SELECT hdi_filesystem_next_id(), target_resource_id, exported_filesystem_id, name, normalized_name,
                    cache_size, namespace_id
                FROM hdi_imported_filesystem WHERE id = source_fs_id)
            RETURNING * INTO new_imported_fs;

        INSERT INTO hdi_imported_filesystem_share (id, resource_id, imported_filesystem_id,
                exported_share_id, name, normalized_name, protocols)
            (SELECT hdi_filesystem_share_next_id(), target_resource_id, new_imported_fs.id,
                    exported_share_id, name, normalized_name, protocols
                FROM hdi_imported_filesystem_share WHERE imported_filesystem_id = source_fs_id);
    END LOOP;

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_count_filtered
Schema: pod
Result Data Type: bigint
Argument Data Types: resource_id bigint, filter_by_column hdi_filesystem_filter_column, filter_by_value character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    query_str1 VARCHAR;
    query_str2 VARCHAR;
    using_arg2 VARCHAR;
    cnt1 BIGINT := 0;
    cnt2 BIGINT := 0;
BEGIN

    IF resource_id IS NULL THEN
        RAISE EXCEPTION 'Null resource_id';
    END IF;

    IF filter_by_column = 'TYPE' AND length(filter_by_value) &gt; 0 THEN
        IF filter_by_value = 'EXPORTED' OR filter_by_value = 'PRIVATE' THEN
            query_str1 := 'SELECT COUNT(*) FROM hdi_local_filesystem
                WHERE resource_id = $1 AND TYPE = $2::hdi_local_filesystem_type ';
            -- query_str2 remains null;
            using_arg2 := filter_by_value;
        ELSIF filter_by_value = 'IMPORTED' THEN
            query_str1 := 'SELECT COUNT(*) FROM hdi_imported_filesystem WHERE resource_id = $1';
            -- query_str2 remains null;
            -- no using_arg2 required; leave null
        ELSE
            -- no results, because filtering on a bogus type
            RETURN 0;
        END IF;
    ELSIF filter_by_column = 'NAME' THEN
        query_str1 := 'SELECT COUNT(*) FROM hdi_local_filesystem WHERE resource_id = $1 AND name like $2';
        query_str2 := 'SELECT COUNT(*) FROM hdi_imported_filesystem WHERE resource_id = $1 AND name like $2';
        using_arg2 := filter_by_value || '%';
    ELSE
        query_str1 := 'SELECT COUNT(*) FROM hdi_local_filesystem WHERE resource_id = $1';
        query_str2 := 'SELECT COUNT(*) FROM hdi_imported_filesystem WHERE resource_id = $1';
        -- no using_arg2 required; leave null
    END IF;


    IF using_arg2 IS NULL THEN
        --RAISE notice 'Executing:  % USING resource_id', query_str1;
        EXECUTE query_str1 USING resource_id INTO cnt1;

        IF query_str2 IS NOT NULL THEN
            --RAISE notice 'Executing:  % USING resource_id', query_str2;
            EXECUTE query_str2 USING resource_id INTO cnt2;
        END IF;
    ELSE
        --RAISE notice 'Executing:  % USING resource_id, %', query_str1, using_arg2;
        EXECUTE query_str1 USING resource_id, using_arg2 INTO cnt1;

        IF query_str2 IS NOT NULL THEN
            --RAISE notice 'Executing:  % USING resource_id, %', query_str2, using_arg2;
            EXECUTE query_str2 USING resource_id, using_arg2 INTO cnt2;
        END IF;
    END IF;

    RETURN cnt1 + cnt2;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_count_for_resource
Schema: pod
Result Data Type: bigint
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT
        (SELECT COUNT(*) FROM hdi_local_filesystem WHERE resource_id = $1) +
        (SELECT COUNT(*) FROM hdi_imported_filesystem WHERE resource_id = $1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_decommission_filesystems
Schema: pod
Result Data Type: boolean
Argument Data Types: decommissioned_device_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    decommissioned_device hdi_device;
    local_fs_id BIGINT;
BEGIN

    -- Delete all imported filesystems (including cascading delete of imported shares) that import from the decommissioned device.
    -- Also updates the config version of any resources with affected imported filesystems.
    FOR local_fs_id IN SELECT id FROM hdi_local_filesystem WHERE resource_id = decommissioned_device_id LOOP
        PERFORM hdi_imported_filesystem_delete_all_imported_from_local_fs(local_fs_id);
    END LOOP;

    -- orphan all namespaces owned by the decommissioned device (its local filesystems)
    PERFORM namespace_orphan_namespaces_owned_by_device(decommissioned_device_id);

    -- for all imported filesystems, reset the namespace's read-only creds, and bump config version of other affected resources
    PERFORM hdi_filesystem_reset_namespace_creds_for_sister_importers(decommissioned_device_id);

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_ensure_name_not_used
Schema: pod
Result Data Type: void
Argument Data Types: fs_resource_id bigint, fs_normalized_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    cnt BIGINT;
BEGIN
    -- make sure that no other local or imported filesystem for the same resource has the same name
    SELECT COUNT(*) FROM hdi_local_filesystem
        WHERE resource_id = fs_resource_id AND normalized_name = fs_normalized_name INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM NAME CONFLICT : %', fs_normalized_name;
    END IF;
    SELECT COUNT(*) FROM hdi_imported_filesystem
        WHERE resource_id = fs_resource_id AND normalized_name = fs_normalized_name INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM NAME CONFLICT : %', fs_normalized_name;
    END IF;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_ensure_name_not_used_by_other_fs
Schema: pod
Result Data Type: void
Argument Data Types: fs_id bigint, fs_normalized_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_resource_id BIGINT;
    cnt BIGINT;
BEGIN
    SELECT resource_id FROM hdi_local_filesystem WHERE id = fs_id INTO fs_resource_id;
    -- make sure that no other local or imported filesystem for the same resource has the same name
    SELECT COUNT(*) FROM hdi_local_filesystem
        WHERE resource_id = fs_resource_id AND normalized_name = fs_normalized_name
            AND id &lt;&gt; fs_id INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM NAME CONFLICT : %', fs_normalized_name;
    END IF;
    SELECT COUNT(*) FROM hdi_imported_filesystem
        WHERE resource_id = fs_resource_id AND normalized_name = fs_normalized_name
            AND id &lt;&gt; fs_id INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM NAME CONFLICT : %', fs_normalized_name;
    END IF;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_ensure_sufficient_cache
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_resource_id bigint, fs_id_to_exclude bigint, fs_cache_requested bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    used_cache BIGINT;
    cur_total_cache BIGINT;
    cur_available BIGINT;
BEGIN
    IF fs_id_to_exclude IS NOT NULL THEN
        SELECT hdi_filesystem_get_allocated_cache_excluding_filesystem(
            fs_resource_id, fs_id_to_exclude) INTO used_cache;
    ELSE
        SELECT hdi_filesystem_get_allocated_cache(fs_resource_id) INTO used_cache;
    END IF;
    SELECT total_cache FROM hdi_device where device_id = fs_resource_id INTO cur_total_cache;
    IF cur_total_cache IS NOT NULL AND cur_total_cache &gt; 0 AND used_cache + fs_cache_requested &gt; cur_total_cache THEN
        RAISE EXCEPTION 'HDI INSUFFICIENT CACHE : % : %', fs_cache_requested, cur_total_cache - used_cache;
    END IF;

    RETURN TRUE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_get_allocated_cache
Schema: pod
Result Data Type: bigint
Argument Data Types: rs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT
        coalesce((SELECT SUM(cache_size)::BIGINT FROM hdi_local_filesystem WHERE resource_id = $1), 0) +
        coalesce((SELECT SUM(cache_size)::BIGINT FROM hdi_imported_filesystem WHERE resource_id = $1), 0);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_get_allocated_cache_excluding_filesystem
Schema: pod
Result Data Type: bigint
Argument Data Types: rs_id bigint, fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT
        coalesce((SELECT SUM(cache_size)::BIGINT FROM hdi_local_filesystem WHERE resource_id = $1 AND id &lt;&gt; $2), 0) +
        coalesce((SELECT SUM(cache_size)::BIGINT FROM hdi_imported_filesystem WHERE resource_id = $1 AND id &lt;&gt; $2), 0);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_list_filtered_sorted_paged
Schema: pod
Result Data Type: SETOF hdi_filesystem_summary
Argument Data Types: resource_id bigint, filter_by_column hdi_filesystem_filter_column, filter_by_value character varying, order_by_column hdi_filesystem_sort_column, is_descending boolean, limit_cnt bigint, offset_cnt bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    select_str VARCHAR;
    sort_direction VARCHAR := 'ASC';
    order_by_clause VARCHAR := '';
    query_str VARCHAR;
    using_arg2 VARCHAR;
BEGIN

    IF resource_id IS NULL THEN
        RAISE EXCEPTION 'Null resource_id';
    END IF;

    IF filter_by_column = 'TYPE' AND length(filter_by_value) &gt; 0 THEN
        IF filter_by_value = 'EXPORTED' OR filter_by_value = 'PRIVATE' THEN
            select_str := 'SELECT id, resource_id, name, type::varchar, cache_size FROM hdi_local_filesystem
                WHERE resource_id = $1 AND TYPE = $2::hdi_local_filesystem_type ';
            using_arg2 := filter_by_value;
        ELSIF filter_by_value = 'IMPORTED' THEN
            select_str := $q$SELECT import.id AS id, import.resource_id AS resource_id, export.name AS name,
                    'IMPORTED'::varchar AS type, import.cache_size AS cache_size
                 FROM hdi_imported_filesystem import, hdi_local_filesystem export
                 WHERE import.resource_id = $1 AND import.exported_filesystem_id = export.id$q$;
            -- no using_arg2 required; leave null
        ELSE
            -- no results, because filtering on a bogus type
            RETURN;
        END IF;
    ELSIF filter_by_column = 'NAME' THEN
        select_str := $q$(SELECT id, resource_id, name, type::varchar, cache_size
                             FROM hdi_local_filesystem WHERE resource_id = $1 AND name like $2
                         UNION
                          SELECT id, resource_id, name, 'IMPORTED'::varchar AS type, cache_size
                             FROM hdi_imported_filesystem WHERE resource_id = $1 AND name like $2)$q$;
        using_arg2 := filter_by_value || '%';

    ELSE
        select_str := $q$(SELECT id, resource_id, name, type::varchar, cache_size
                             FROM hdi_local_filesystem WHERE resource_id = $1
                         UNION
                          SELECT id, resource_id, name, 'IMPORTED'::varchar AS type, cache_size
                             FROM hdi_imported_filesystem WHERE resource_id = $1)$q$;
        -- no using_arg2 required; leave null
    END IF;


    IF order_by_column IS NULL THEN
        order_by_column := 'NAME'::hdi_filesystem_sort_column;
    END IF;
    IF is_descending THEN
        sort_direction := 'DESC';
    END IF;
    order_by_clause := '
                         ORDER BY ' || order_by_column || ' ' || sort_direction;


    query_str := select_str || order_by_clause || '
        LIMIT ' || limit_cnt || ' OFFSET ' || offset_cnt ;

    IF using_arg2 IS NULL THEN
        --RAISE notice 'Executing:  % USING resource_id', query_str;
        RETURN QUERY EXECUTE query_str USING resource_id;
    ELSE
        --RAISE notice 'Executing:  % USING resource_id, %', query_str, using_arg2;
        RETURN QUERY EXECUTE query_str USING resource_id, using_arg2;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_filesystem_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_reassign_filesystems
Schema: pod
Result Data Type: boolean
Argument Data Types: source_resource_id bigint, target_resource_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- For every local filesystem owned by the device being replaced, clear the owner password
    PERFORM namespace_clear_owner_passwords_for_hdi_device(source_resource_id);
    -- update the replaced device's config version
    PERFORM hdi_config_force_update_config_version(source_resource_id);

    -- for all imported filesystems, reset the namespace's read-only creds, and bump config version of other affected resources
    PERFORM hdi_filesystem_reset_namespace_creds_for_sister_importers(source_resource_id);

    -- reassign source's local and imported filesystems and shares to the target
    UPDATE hdi_local_filesystem SET resource_id = target_resource_id WHERE resource_id = source_resource_id;
    UPDATE hdi_local_filesystem_share SET resource_id = target_resource_id WHERE resource_id = source_resource_id;
    UPDATE hdi_imported_filesystem SET resource_id = target_resource_id WHERE resource_id = source_resource_id;
    UPDATE hdi_imported_filesystem_share SET resource_id = target_resource_id WHERE resource_id = source_resource_id;

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_report
Schema: pod
Result Data Type: SETOF hdi_filesystem_report_result
Argument Data Types: order_by_column hdi_filesystem_report_sort_column, is_descending boolean, limit_cnt bigint, offset_cnt bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sort_direction VARCHAR := 'ASC';
    query_str VARCHAR;
BEGIN

    IF is_descending THEN
        sort_direction := 'DESC';
    END IF;

    query_str := $a$
        SELECT d.device_id AS DEVICE_ID, d.serial_number AS SERIAL_NUMBER, d.name AS DEVICE_NAME,
               f.id AS FS_ID, f.name AS FS_NAME, f.type::varchar AS FS_TYPE,
               n.namespace_id AS NS_ID, n.name AS NS_NAME, n.percent_used AS NS_UTILIZATION_PERCENT,
               n.space_used AS NS_SPACE_USED, n.total_space AS NS_QUOTA,
               f.reported_cache_utilization_percent AS CACHE_UTILIZATION_PERCENT,
               f.reported_cache_free AS CACHE_FREE, f.reported_cache_size AS CACHE_SIZE
        FROM hdi_device d, hdi_local_filesystem f, namespace n
        WHERE is_in_service(d.state) AND d.device_id = f.resource_id AND f.namespace_id = n.namespace_id
        UNION
        SELECT d.device_id AS DEVICE_ID, d.serial_number AS SERIAL_NUMBER, d.name AS DEVICE_NAME,
               f.id AS FS_ID, f.name AS FS_NAME, 'IMPORTED' AS FS_TYPE,
               n.namespace_id AS NS_ID, n.name AS NS_NAME, n.percent_used AS NS_UTILIZATION_PERCENT,
               n.space_used AS NS_SPACE_USED, n.total_space AS NS_QUOTA,
               f.reported_cache_utilization_percent AS CACHE_UTILIZATION_PERCENT,
               f.reported_cache_free AS CACHE_FREE, f.reported_cache_size AS CACHE_SIZE
        FROM hdi_device d, hdi_imported_filesystem f, namespace n
        WHERE is_in_service(d.state) AND d.device_id = f.resource_id AND f.namespace_id = n.namespace_id
        ORDER BY $a$ || order_by_column || ' ' || sort_direction  || '
        LIMIT ' || limit_cnt || ' OFFSET ' || offset_cnt ;
    --RAISE notice 'Executing:  %', query_str;
    RETURN QUERY EXECUTE query_str;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_report_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT
        coalesce((SELECT COUNT(*)
                  FROM hdi_device d, hdi_local_filesystem f, namespace n
                  WHERE is_in_service(d.state) AND d.device_id = f.resource_id AND f.namespace_id = n.namespace_id), 0) +
        coalesce((SELECT COUNT(*)
                  FROM hdi_device d, hdi_imported_filesystem f, namespace n
                  WHERE is_in_service(d.state) AND d.device_id = f.resource_id AND f.namespace_id = n.namespace_id), 0);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_reset_namespace_creds
Schema: pod
Result Data Type: boolean
Argument Data Types: local_fs_namespace_id bigint, clear_writer_creds boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN

    IF clear_writer_creds THEN
        -- clear both read-only and read/write passwords for the namespace associated with the local filesystem
        PERFORM namespace_clear_passwords(local_fs_namespace_id);
    ELSE
        -- clear the read-only password for the namespace associated with the local filesystem
        PERFORM namespace_clear_read_only_password(local_fs_namespace_id);
    END IF;

    -- update the config version of all importers of the local filesystem
    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id IN
            (SELECT resource_id FROM hdi_imported_filesystem WHERE namespace_id = local_fs_namespace_id);

    RETURN TRUE;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_reset_namespace_creds_for_sister_importers
Schema: pod
Result Data Type: void
Argument Data Types: source_resource_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    local_fs_namespace_id BIGINT;
BEGIN
    -- For each local filesystem that the source imports from ...
    FOR local_fs_namespace_id IN
        SELECT lf.namespace_id FROM hdi_local_filesystem lf, hdi_imported_filesystem if
            WHERE if.resource_id = source_resource_id AND if.exported_filesystem_id = lf.id LOOP

        PERFORM hdi_filesystem_reset_namespace_creds(local_fs_namespace_id, FALSE);

    END LOOP;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_share_get_count_with_protocol
Schema: pod
Result Data Type: bigint
Argument Data Types: resource_id bigint, protocols hdi_filesystem_share_protocols
Volatility: volatile
Language: sql
Source Code:

    SELECT
        coalesce((SELECT COUNT(*) FROM hdi_local_filesystem_share sh, hdi_local_filesystem fs
            WHERE fs.resource_id = $1 AND fs.id = sh.filesystem_id AND sh.protocols = $2), 0) +
        coalesce((SELECT COUNT(*) FROM hdi_imported_filesystem_share sh, hdi_imported_filesystem fs
            WHERE fs.resource_id = $1 AND fs.id = sh.imported_filesystem_id AND sh.protocols = $2), 0);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_share_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_filesystem_share_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_suspend_filesystems
Schema: pod
Result Data Type: boolean
Argument Data Types: suspended_resource_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- For every local filesystem owned by the device being suspended, clear the owner password
    PERFORM namespace_clear_owner_passwords_for_hdi_device(suspended_resource_id);
    -- update the resource's config version
    PERFORM hdi_config_force_update_config_version(suspended_resource_id);

    -- for all imported filesystems, reset the namespace's read-only creds, and bump config version of other affected resources
    PERFORM hdi_filesystem_reset_namespace_creds_for_sister_importers(suspended_resource_id);

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_update_namespace_read_only_user_creds
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: ns_id bigint, xid bigint, username character varying, password character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result namespace;
BEGIN

    SELECT * FROM namespace_update_read_only_account(ns_id, xid, username, password) INTO result;
    IF result.namespace_id IS NOT NULL THEN
        -- update the config version of all importers of the namespace
        UPDATE hdi_config
            SET version_id = hdi_config_next_version(version_id), last_change_time = now()
            WHERE resource_id IN
                (SELECT resource_id FROM hdi_imported_filesystem WHERE namespace_id = ns_id);
        RETURN NEXT result;
    END IF;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_filesystem_update_namespace_user_creds
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: ns_id bigint, xid bigint, username character varying, password character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result namespace;
BEGIN

    FOR result IN SELECT * FROM namespace_update_account(ns_id, xid, username, password) LOOP
        IF result.namespace_id IS NOT NULL THEN
            -- update the config version of all writers of the namespace
            UPDATE hdi_config
                SET version_id = hdi_config_next_version(version_id), last_change_time = now()
                WHERE resource_id IN
                    (SELECT resource_id FROM hdi_local_filesystem WHERE namespace_id = ns_id);
            IF result.namespace_id = ns_id THEN
                RETURN NEXT result;
            END IF;
        END IF;
    END LOOP;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_fs_share_ensure_name_not_used
Schema: pod
Result Data Type: void
Argument Data Types: share_resource_id bigint, share_normalized_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    cnt BIGINT;
BEGIN
    -- make sure that no other local or imported share for the same resource has the same name
    SELECT COUNT(*) FROM hdi_local_filesystem_share
        WHERE resource_id = share_resource_id AND normalized_name = share_normalized_name INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM SHARE NAME CONFLICT : %', share_normalized_name;
    END IF;
    SELECT COUNT(*) FROM hdi_imported_filesystem_share
        WHERE resource_id = share_resource_id AND normalized_name = share_normalized_name INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM SHARE NAME CONFLICT : %', share_normalized_name;
    END IF;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_fs_share_ensure_name_not_used_by_other
Schema: pod
Result Data Type: void
Argument Data Types: share_id bigint, share_normalized_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    share_resource_id BIGINT;
    cnt BIGINT;
BEGIN
    SELECT resource_id FROM hdi_local_filesystem_share WHERE id = share_id INTO share_resource_id;
    -- make sure that no other local or imported share for the same resource has the same name
    SELECT COUNT(*) FROM hdi_local_filesystem_share
        WHERE resource_id = share_resource_id AND normalized_name = share_normalized_name
            AND id &lt;&gt; share_id INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM SHARE NAME CONFLICT : %', share_normalized_name;
    END IF;
    SELECT COUNT(*) FROM hdi_imported_filesystem_share
        WHERE resource_id = share_resource_id AND normalized_name = share_normalized_name
            AND id &lt;&gt; share_id INTO cnt;
    IF cnt &gt; 0 THEN
        RAISE EXCEPTION 'HDI FILESYSTEM SHARE NAME CONFLICT : %', share_normalized_name;
    END IF;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_get_local_filesystem_namespace
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT n.*
    FROM hdi_local_filesystem f, namespace n
    WHERE f.resource_id = $1 
    AND f.namespace_id = n.namespace_id
    AND NOT n.is_orphaned
    LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_health_report_create
Schema: pod
Result Data Type: SETOF hdi_health_report
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO hdi_health_report (device_id) VALUES ($1) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_health_report_delete
Schema: pod
Result Data Type: SETOF hdi_health_report
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_health_report WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_health_report_lookup
Schema: pod
Result Data Type: SETOF hdi_health_report
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_health_report where device_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_health_report_update
Schema: pod
Result Data Type: SETOF hdi_health_report
Argument Data Types: device_id bigint, health_report character varying, hostname character varying, ip_address character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_health_report
        SET health_report = $2, hostname = $3, ip_address = $4
        WHERE device_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_create
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: fs_resource_id bigint, fs_exported_filesystem_id bigint, fs_name character varying, fs_cache_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_normalized_name VARCHAR;
    exported_fs_type hdi_local_filesystem_type;
    is_device_in_service BOOLEAN;
    cnt BIGINT;
    fs_namespace_id BIGINT;
BEGIN
    -- make sure that the filesystem to import is in fact an EXPORTED filesystem from a DEVICE that is IN-SERVICE
    SELECT fs.type, is_in_service(d.state), fs.namespace_id
        FROM hdi_local_filesystem fs, hdi_device d
        WHERE fs.id = fs_exported_filesystem_id AND fs.resource_id = d.device_id
        INTO exported_fs_type, is_device_in_service, fs_namespace_id;
    IF exported_fs_type IS NULL THEN
        -- no matching rows found; either device or filesystem doesn't exist
        RAISE EXCEPTION 'No such filesystem belonging to device found: %', fs_exported_filesystem_id;
    END IF;
    IF exported_fs_type &lt;&gt; 'EXPORTED' THEN
        RAISE EXCEPTION 'Filesystem to import is not exported: %', fs_exported_filesystem_id;
    END IF;
    IF NOT is_device_in_service THEN
        RAISE EXCEPTION 'Filesystem belongs to a device that is not in service: %', fs_exported_filesystem_id;
    END IF;

    -- make sure the filesystem name isn't already in use
    fs_normalized_name := normalize(fs_name);
    PERFORM hdi_filesystem_ensure_name_not_used(fs_resource_id, fs_normalized_name);

    PERFORM hdi_filesystem_ensure_sufficient_cache(fs_resource_id, NULL, fs_cache_size);

    PERFORM limit_hdi_filesystems_per_device(hdi_filesystem_count_for_resource(fs_resource_id) + 1);

    RETURN QUERY INSERT INTO hdi_imported_filesystem (id, resource_id, exported_filesystem_id,
        name, normalized_name, cache_size, namespace_id)
        VALUES (hdi_filesystem_next_id(), fs_resource_id,  fs_exported_filesystem_id,
        fs_name, fs_normalized_name, fs_cache_size, fs_namespace_id)
        RETURNING *;
EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI IMPORTED FILESYSTEM CONFLICT';

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_delete
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_imported_filesystem_share WHERE imported_filesystem_id = $1;
    DELETE FROM hdi_imported_filesystem WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_delete_all_imported_from_local_fs
Schema: pod
Result Data Type: void
Argument Data Types: local_fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_imported_filesystem_share WHERE imported_filesystem_id IN
        (SELECT id FROM hdi_imported_filesystem WHERE exported_filesystem_id = $1);
    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id IN (SELECT resource_id FROM hdi_imported_filesystem WHERE exported_filesystem_id = $1);
    DELETE FROM hdi_imported_filesystem WHERE exported_filesystem_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_lookup
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_imported_filesystem WHERE id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_share_create
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem_share_result
Argument Data Types: imported_fs_id bigint, exported_fs_id bigint, exported_share_id bigint, share_name character varying, protocols_to_use hdi_filesystem_share_protocols
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    share_normalized_name VARCHAR;
    created_share hdi_imported_filesystem_share;
    result hdi_imported_filesystem_share_result;
BEGIN
    -- Make sure that the exported share id really is a share of the exported filesystem id and that the
    -- exported filesystem id really represents a filesystem that is in fact exported.
    -- imported_filesystem_id column is a foreign key, so that check is handled by foreign key constraint
    SELECT hdi_filesystem_share_next_id(), imported_fs.id,
           local_share.id, protocols_to_use, share_name, imported_fs.resource_id, local_share.name
         FROM hdi_local_filesystem_share local_share, hdi_local_filesystem local_fs,
              hdi_imported_filesystem imported_fs
         WHERE
             imported_fs.id = imported_fs_id
             AND local_fs.id = exported_fs_id
             AND local_share.id = exported_share_id
             AND local_fs.id = local_share.filesystem_id
             AND local_fs.type = 'EXPORTED'
         INTO result;

    IF result.id IS NOT NULL THEN
        -- make sure the share name isn't already in use
        share_normalized_name := normalize(share_name);
        PERFORM hdi_fs_share_ensure_name_not_used(result.resource_id, share_normalized_name);

        INSERT INTO hdi_imported_filesystem_share (id, resource_id, imported_filesystem_id,
                exported_share_id, name, normalized_name, protocols)
            VALUES (result.id, result.resource_id, result.imported_filesystem_id,
                result.exported_share_id, result.name, share_normalized_name, result.protocols)
            RETURNING * INTO created_share;
        IF created_share.id IS NOT NULL THEN
           RETURN NEXT result;
        END IF;
    END IF;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_share_delete_shares
Schema: pod
Result Data Type: boolean
Argument Data Types: VARIADIC imported_share_ids bigint[]
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_imported_filesystem_share WHERE id = ANY($1);
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_share_enforce_limit
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rs_id BIGINT;
    count BIGINT;
BEGIN
    SELECT COUNT(*) FROM hdi_imported_filesystem_share WHERE imported_filesystem_id = $1 INTO count;
    PERFORM limit_hdi_shares_per_filesystems(count);

    SELECT resource_id FROM hdi_imported_filesystem WHERE id = fs_id INTO rs_id;
    SELECT
        (SELECT COUNT(*) FROM hdi_local_filesystem_share WHERE resource_id = rs_id AND protocols &lt;&gt; 'CIFS') +
        (SELECT COUNT(*) FROM hdi_imported_filesystem_share WHERE resource_id = rs_id AND protocols &lt;&gt; 'CIFS')
        INTO count;
    PERFORM limit_hdi_nfs_shares_per_device(count);

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_share_update
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem_share_result
Argument Data Types: imported_share_id bigint, share_name character varying, protocols_to_use hdi_filesystem_share_protocols
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    share_normalized_name VARCHAR;
    imported_resource_id BIGINT;
    updated_share hdi_imported_filesystem_share;
    result hdi_imported_filesystem_share_result;
BEGIN
    -- make sure the share name isn't already in use
    share_normalized_name := normalize(share_name);
    PERFORM hdi_fs_share_ensure_name_not_used_by_other(imported_share_id, share_normalized_name);


    -- Select into result (which includes share name from hdi_local_filesystem_share table)
    SELECT imported_share.id, imported_share.imported_filesystem_id, imported_share.exported_share_id,
             protocols_to_use, share_name,  imported_share.resource_id, local_share.name
         FROM hdi_local_filesystem_share local_share, hdi_imported_filesystem_share imported_share
         WHERE imported_share.id = $1 AND local_share.id = imported_share.exported_share_id
         INTO result;

    IF result.id IS NOT NULL THEN
        -- make sure the share name isn't already in use by another share
        share_normalized_name := normalize(share_name);
        PERFORM hdi_fs_share_ensure_name_not_used(imported_resource_id, share_normalized_name);

        UPDATE hdi_imported_filesystem_share
            SET name = share_name, normalized_name = share_normalized_name, protocols = protocols_to_use
            WHERE id = imported_share_id
            RETURNING * INTO updated_share;
        IF updated_share.id IS NOT NULL THEN
           RETURN NEXT result;
        END IF;
    END IF;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_shares_list
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem_share_result
Argument Data Types: filesystem_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT i.id, i.imported_filesystem_id, i.exported_share_id, i.protocols, i.name, i.resource_id, e.name
     FROM hdi_imported_filesystem_share i, hdi_local_filesystem_share e
     WHERE imported_filesystem_id = $1 AND e.id = i.exported_share_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_update
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: fs_id bigint, cache_size bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT hdi_filesystem_ensure_sufficient_cache(resource_id, $1, $2)
       FROM hdi_imported_filesystem WHERE id = $1;

    UPDATE hdi_imported_filesystem SET cache_size = $2 WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_imported_filesystem_update_reported_cache
Schema: pod
Result Data Type: SETOF hdi_imported_filesystem
Argument Data Types: id bigint, cache_size integer, cache_free integer, cache_utilization_percent integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_imported_filesystem
        SET reported_cache_size = $2, reported_cache_free = $3, reported_cache_utilization_percent = $4
        WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_is_ten_public_addr_misconfigured
Schema: pod
Result Data Type: boolean
Argument Data Types: config hdi_config
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    ten tenant;
    is_misconfigured BOOLEAN := FALSE;
BEGIN
    IF config.use_tenant_public_address THEN
        IF config.tenant_id IS NOT NULL THEN
            SELECT * FROM tenant WHERE tenant_id = config.tenant_id INTO ten;
            IF ten.tenant_id IS NOT NULL AND tenant_is_missing_public_addr(ten) THEN
                is_misconfigured := TRUE;
            END IF;
        END IF;
        IF is_misconfigured = FALSE THEN
            -- check if there are imported filesystems that use a tenant that doesn't have public addr set
            FOR ten IN
                SELECT t.*
                  FROM tenant t, hdi_config lc, hdi_local_filesystem lf, hdi_imported_filesystem if
                 WHERE t.tenant_id = lc.tenant_id AND lc.resource_id = lf.resource_id
                   AND lf.id = if.exported_filesystem_id AND if.resource_id = config.resource_id LOOP
                is_misconfigured := is_misconfigured OR tenant_is_missing_public_addr(ten);
            END LOOP;
        END IF;
    END IF;

    RETURN is_misconfigured;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_compare_hcp_versioning_days_to_keep
Schema: pod
Result Data Type: boolean
Argument Data Types: filesystem_id bigint, old_hcp_versioning_days_to_keep integer, new_hcp_versioning_days_to_keep integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF old_hcp_versioning_days_to_keep != new_hcp_versioning_days_to_keep THEN
        PERFORM pgq.insert_event('async_task', 'FILESYSTEM_VERSION', cast(filesystem_id AS text));
        RETURN TRUE;
    END IF;
    RETURN FALSE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_create
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: fs_resource_id bigint, fs_type hdi_local_filesystem_type, fs_name character varying, fs_cache_size bigint, fs_settings_api_version character varying, fs_hcp_versioning_days_to_keep integer, fs_settings character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_normalized_name VARCHAR;
    result hdi_local_filesystem;
BEGIN

    fs_normalized_name := normalize(fs_name);
    PERFORM hdi_filesystem_ensure_name_not_used(fs_resource_id, fs_normalized_name);

    PERFORM hdi_filesystem_ensure_sufficient_cache(fs_resource_id, NULL, fs_cache_size);

    PERFORM limit_hdi_filesystems_per_device(hdi_filesystem_count_for_resource(fs_resource_id) + 1);

    PERFORM hdi_device_schedule_namespace_creation(fs_resource_id);

    RETURN QUERY INSERT INTO hdi_local_filesystem (id, resource_id, type, name, normalized_name, cache_size,
            settings_api_version, hcp_versioning_days_to_keep, settings)
        VALUES (hdi_filesystem_next_id(), fs_resource_id, fs_type, fs_name, fs_normalized_name, fs_cache_size,
            fs_settings_api_version, fs_hcp_versioning_days_to_keep, fs_settings)
        RETURNING *;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_delete
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_namespace_id BIGINT;
BEGIN
    PERFORM hdi_imported_filesystem_delete_all_imported_from_local_fs(fs_id);
    DELETE FROM hdi_local_filesystem_share WHERE filesystem_id = fs_id;

    -- clear the namespace's passwords
    SELECT namespace_id FROM hdi_local_filesystem WHERE id = fs_id INTO fs_namespace_id;
    PERFORM namespace_clear_passwords(fs_namespace_id);

    PERFORM namespace_orphan(fs_namespace_id);
    RETURN QUERY DELETE FROM hdi_local_filesystem WHERE id = fs_id RETURNING *;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_get_count_imported_from_local_fs
Schema: pod
Result Data Type: bigint
Argument Data Types: local_fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_imported_filesystem WHERE exported_filesystem_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_list_all_without_namespaces
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_local_filesystem WHERE resource_id = $1 AND namespace_id IS NULL;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_lookup
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: filesystem_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_local_filesystem WHERE id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_share_create
Schema: pod
Result Data Type: SETOF hdi_local_filesystem_share
Argument Data Types: fs_id bigint, share_name character varying, protocols hdi_filesystem_share_protocols
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rs_id BIGINT;
    share_normalized_name VARCHAR;
    cnt BIGINT;
BEGIN
    share_normalized_name := normalize(share_name);

    -- Look up the resource id of the local filesystem
    SELECT resource_id FROM hdi_local_filesystem WHERE id = fs_id INTO rs_id;

    -- make sure that no other share for the same resource has the same name
    PERFORM hdi_fs_share_ensure_name_not_used(rs_id, share_normalized_name);

    RETURN QUERY INSERT INTO hdi_local_filesystem_share (id, resource_id, filesystem_id, name, normalized_name, protocols)
        VALUES (hdi_filesystem_share_next_id(), rs_id, fs_id, share_name, share_normalized_name, protocols)
        RETURNING *;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_share_delete_shares
Schema: pod
Result Data Type: boolean
Argument Data Types: VARIADIC local_share_ids bigint[]
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_config
        SET version_id = hdi_config_next_version(version_id), last_change_time = now()
        WHERE resource_id IN (SELECT resource_id FROM hdi_imported_filesystem WHERE id IN
            (SELECT imported_filesystem_id FROM hdi_imported_filesystem_share WHERE exported_share_id = ANY($1)));
    DELETE FROM hdi_imported_filesystem_share WHERE exported_share_id = ANY($1);
    DELETE FROM hdi_local_filesystem_share WHERE id = ANY($1);
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_share_enforce_limit
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    count BIGINT;
    rs_id BIGINT;
BEGIN
    SELECT COUNT(*) FROM hdi_local_filesystem_share WHERE filesystem_id = $1 INTO count;
    PERFORM limit_hdi_shares_per_filesystems(count);

    SELECT resource_id FROM hdi_local_filesystem WHERE id = fs_id INTO rs_id;
    SELECT
        (SELECT COUNT(*) FROM hdi_local_filesystem_share WHERE resource_id = rs_id AND protocols &lt;&gt; 'CIFS') +
        (SELECT COUNT(*) FROM hdi_imported_filesystem_share WHERE resource_id = rs_id AND protocols &lt;&gt; 'CIFS')
        INTO count;
    PERFORM limit_hdi_nfs_shares_per_device(count);

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_share_list_shares
Schema: pod
Result Data Type: SETOF hdi_local_filesystem_share
Argument Data Types: filesystem_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_local_filesystem_share WHERE filesystem_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_shares_list_exported_shares
Schema: pod
Result Data Type: SETOF hdi_local_filesystem_share
Argument Data Types: filesystem_id bigint
Volatility: volatile
Language: sql
Source Code:

    -- We need to make sure the filesystem is in fact exported
    SELECT sh.* FROM hdi_local_filesystem_share sh, hdi_local_filesystem fs
        WHERE fs.id = $1 AND fs.type = 'EXPORTED' AND fs.id = sh.filesystem_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_update
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: filesystem_id bigint, new_type hdi_local_filesystem_type, new_name character varying, new_cache_size bigint, new_settings_api_version character varying, new_hcp_versioning_days_to_keep integer, new_settings character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_normalized_name VARCHAR;
    cnt BIGINT;
    result hdi_local_filesystem;
    rs_id BIGINT;
BEGIN

    fs_normalized_name := normalize(new_name);
    PERFORM hdi_filesystem_ensure_name_not_used_by_other_fs(filesystem_id, fs_normalized_name);

    SELECT resource_id FROM hdi_local_filesystem WHERE id = filesystem_id INTO rs_id;
    PERFORM hdi_filesystem_ensure_sufficient_cache(rs_id, filesystem_id, new_cache_size);

    RETURN QUERY UPDATE hdi_local_filesystem SET type = new_type, name = new_name, normalized_name = fs_normalized_name,
        cache_size = new_cache_size, settings_api_version = new_settings_api_version, 
        pending_hcp_versioning_days_to_keep_change = (pending_hcp_versioning_days_to_keep_change OR
            hdi_local_filesystem_compare_hcp_versioning_days_to_keep(filesystem_id, hcp_versioning_days_to_keep, new_hcp_versioning_days_to_keep)),
        hcp_versioning_days_to_keep = new_hcp_versioning_days_to_keep, settings = new_settings
        WHERE id = $1 RETURNING *;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_update_namespace
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: filesystem_id bigint, new_namespace_id bigint, device_xid bigint, config_version_id bigint
Volatility: volatile
Language: sql
Source Code:


    UPDATE hdi_local_filesystem f
       SET namespace_id = $2
       FROM hdi_device d, hdi_config c
       WHERE f.id = $1 AND f.resource_id = d.device_id AND d.xid = $3
           AND c.resource_id = f.resource_id AND c.version_id = $4 RETURNING f.*;


Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_local_filesystem_update_reported_cache
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: id bigint, cache_size integer, cache_free integer, cache_utilization_percent integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_local_filesystem
        SET reported_cache_size = $2, reported_cache_free = $3, reported_cache_utilization_percent = $4
        WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_localfs_clear_pending_hcp_versioning_days_to_keep_change
Schema: pod
Result Data Type: SETOF hdi_local_filesystem
Argument Data Types: filesystem_id bigint, hcp_versioning_days_to_keep integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_local_filesystem SET pending_hcp_versioning_days_to_keep_change = FALSE
    WHERE id = $1 AND hcp_versioning_days_to_keep = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT count(*) FROM hdi_model_number;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_count
Schema: pod
Result Data Type: bigint
Argument Data Types: pattern character varying
Volatility: stable
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_model_number WHERE normalize(model_number) LIKE normalize($1) || '%' ;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_create
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: model_number character varying, cache_size bigint, description character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY INSERT INTO hdi_model_number (model_number_id, model_number, cache_size, description, xid)
        (SELECT hdi_model_number_next_id, $1, $2, $3, xid_next(hdi_model_number_next_id)
            FROM hdi_model_number_next_id()) RETURNING *;
EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI MODEL NUMBER CONFLICT : %', model_number;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_delete
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: model_number_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_model_number WHERE model_number_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_list
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: limit_cnt bigint, offset_cnt bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM hdi_model_number ORDER BY normalize(model_number) LIMIT $1 OFFSET $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_list
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: pattern character varying, limit_cnt bigint, offset_cnt bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM hdi_model_number
        WHERE normalize(model_number) LIKE normalize($1) || '%'
        ORDER BY normalize(model_number) LIMIT $2 OFFSET $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_lookup
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: model_number character varying
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM hdi_model_number WHERE normalize(model_number) = normalize($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_lookup
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: model_number_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM hdi_model_number WHERE model_number_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_model_number_seq') | resource_type_hdi_model_number();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_model_number_update
Schema: pod
Result Data Type: SETOF hdi_model_number
Argument Data Types: model_id bigint, xxid bigint, modelnum character varying, cachesize bigint, descriptn character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY UPDATE hdi_model_number SET model_number = $3, cache_size = $4, description = $5, xid = xid_next($1)
        WHERE model_number_id = $1 AND xid = $2 RETURNING *;
EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI MODEL NUMBER CONFLICT : %', modelnum;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_orphaned_namespace_report
Schema: pod
Result Data Type: SETOF hdi_orphaned_namespace_report_result
Argument Data Types: order_by_column hdi_orphaned_namespace_report_sort_column, is_descending boolean, limit_cnt bigint, offset_cnt bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sort_direction VARCHAR := 'ASC';
    query_str VARCHAR;
BEGIN

    IF is_descending THEN
        sort_direction := 'DESC';
    END IF;

    query_str := $a$
        SELECT n.namespace_id, n.name AS NS_NAME, n.total_space AS NS_QUOTA, t.tenant_id, t.name AS TENANT_NAME
        FROM namespace n, tenant t
        WHERE n.namespace_owner = 'REMOTE' AND n.is_orphaned = true AND n.tenant_id = t.tenant_id
        ORDER BY $a$ || order_by_column || ' ' || sort_direction  || '
        LIMIT ' || limit_cnt || ' OFFSET ' || offset_cnt ;
    RETURN QUERY EXECUTE query_str;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_orphaned_namespace_report_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM namespace n, tenant t
       WHERE n.namespace_owner = 'REMOTE' AND n.is_orphaned = true AND n.tenant_id = t.tenant_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_orphaned_namespaces_with_username
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: start bigint, max integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM namespace WHERE 
        ($1 IS NULL OR namespace_id &gt; $1) AND
        is_orphaned = TRUE AND
        namespace_owner = 'REMOTE' AND 
        (username IS NOT NULL OR read_only_username IS NOT NULL)
        ORDER BY namespace_id
        LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_delete
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: tagid bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_tag_assoc WHERE tag_id = $1;
    DELETE FROM hdi_tag WHERE tag_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_delete_assoc
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: resourceid bigint, tagid bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM hdi_tag_assoc WHERE resource_id = $1 AND tag_id = $2;
    DELETE FROM hdi_tag WHERE tag_id = $2 AND NOT hdi_tag_is_assoc($2) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_find_matching
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: prefix character varying, max_results integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF max_results &gt; 0 THEN
        RETURN QUERY EXECUTE
            $q$ SELECT * FROM hdi_tag WHERE normalize(tag) LIKE $1 LIMIT $2 $q$
            USING normalize(prefix) || '%', max_results;
    ELSE
        RETURN QUERY EXECUTE
            $q$ SELECT * FROM hdi_tag WHERE normalize(tag) LIKE $1 $q$
            USING normalize(prefix) || '%';
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_find_or_create
Schema: pod
Result Data Type: hdi_tag
Argument Data Types: tag_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result hdi_tag;
BEGIN
    SELECT * FROM hdi_tag WHERE normalize(tag) = normalize(tag_name) INTO result;
    IF result.tag_id IS NULL THEN
        INSERT INTO hdi_tag (tag_id, tag, xid) VALUES (hdi_tag_next_id(), tag_name, xid_next())
            RETURNING * INTO result;
    END IF;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_is_assoc
Schema: pod
Result Data Type: boolean
Argument Data Types: tagid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT 1 FROM hdi_tag_assoc WHERE tag_id = $1 LIMIT 1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_list
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_tag ORDER by normalize(tag);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_lookup
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: tagid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_tag WHERE tag_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_lookup_tags_for_resource
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: resourceid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT t.* FROM hdi_tag t, hdi_tag_assoc a WHERE a.resource_id = $1 AND a.tag_id = t.tag_id
       ORDER BY normalize(t.tag);;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_tag_id_seq');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_set
Schema: pod
Result Data Type: boolean
Argument Data Types: resourceid bigint, VARIADIC tags character varying[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    old_tags BIGINT[];
    new_tags BIGINT[] := '{}';
    tags_with_assocs BIGINT[];
    tag_name VARCHAR;
    new_tag hdi_tag;
    tagid BIGINT;
    added_tag BOOLEAN := FALSE;
    added_tag_assoc BOOLEAN := FALSE;
BEGIN
    -- lookup tags currently associated with the resource
    SELECT array(SELECT tag_id FROM hdi_tag_assoc WHERE resource_id = resourceid) INTO old_tags;
    tags_with_assocs := old_tags;

    FOREACH tag_name IN ARRAY tags LOOP
        CONTINUE WHEN tag_name IS NULL; -- due to elvis list to array, we get an extra null entry at end

        -- lookup tag; create a new one if necessary
        new_tag := NULL;
        SELECT * FROM hdi_tag WHERE normalize(tag) = normalize(tag_name) INTO new_tag;
        IF new_tag.tag_id IS NULL THEN
            INSERT INTO hdi_tag (tag_id, tag, xid) VALUES (hdi_tag_next_id(), tag_name, xid_next())
                RETURNING * INTO new_tag;
            added_tag := TRUE;
        END IF;

        -- add new tag association if necessary
        IF NOT new_tag.tag_id = ANY (tags_with_assocs) THEN
            INSERT INTO hdi_tag_assoc (resource_id, tag_id) VALUES (resourceid, new_tag.tag_id);
            added_tag_assoc := TRUE;
            tags_with_assocs := tags_with_assocs || new_tag.tag_id;
        END IF;

        new_tags := new_tags || new_tag.tag_id;
    END LOOP;

    -- delete old tag associations (and tags if appropriate) that are no longer valid
    FOREACH tagid IN ARRAY old_tags LOOP
        IF NOT tagid = ANY (new_tags) THEN
            PERFORM hdi_tag_delete_assoc(resourceid, tagid);
        END IF;
    END LOOP;

    IF added_tag THEN
        PERFORM limit_hdi_tags_in_system(result.cnt) FROM (SELECT COUNT(*) cnt FROM hdi_tag) AS result;
    END IF;

    IF added_tag_assoc THEN
        PERFORM limit_hdi_tags_per_device(result.cnt) FROM (
            SELECT COUNT(*) cnt FROM hdi_tag_assoc WHERE resource_id = resourceid
        ) result;
    END IF;

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_summary_list
Schema: pod
Result Data Type: SETOF hdi_tag_summary_result
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT t.*, hdi_tag_usage_count(t.tag_id)
        FROM (SELECT * FROM hdi_tag) t
        ORDER BY normalize(t.tag);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_update
Schema: pod
Result Data Type: SETOF hdi_tag
Argument Data Types: tagid bigint, new_tag character varying, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_tag SET tag = $2, xid = xid_next()
        WHERE tag_id = $1 AND xid = $3 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_tag_usage_count
Schema: pod
Result Data Type: bigint
Argument Data Types: tagid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_tag_assoc WHERE tag_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_count_all_but_deleted
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM hdi_template WHERE state &lt;&gt; 'DELETED';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_create
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: template_name character varying, template_description character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    template_normalized_name VARCHAR;
    cnt BIGINT;
    result hdi_template;
BEGIN

    PERFORM limit_hdi_templates(hdi_template_count_all_but_deleted() + 1);

    template_normalized_name := normalize(template_name);
    INSERT INTO hdi_template(template_id, name, normalized_name, description, xid)
        (SELECT hdi_template_next_id, template_name, template_normalized_name, template_description, xid_next(hdi_template_next_id)
            FROM hdi_template_next_id()) RETURNING * INTO result;
    RETURN NEXT result;

EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI TEMPLATE NAME CONFLICT : %', template_normalized_name;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_delete
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: template_id bigint, xid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE hdi_template SET state = 'DELETED', xid = xid_next($1)
        WHERE template_id = $1 AND state = 'ACTIVE' AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_lookup_all_but_deleted
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_template where state &lt;&gt; 'DELETED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_lookup_by_id
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: template_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_template where template_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_lookup_by_name
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: name character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_template where name = $1 AND state = 'ACTIVE';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_lookup_by_name_starts_with
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: name_prefix character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM hdi_template WHERE state = 'ACTIVE' AND name LIKE $1 || '%';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('hdi_template_id_seq') | resource_type_hdi_template();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_template_update
Schema: pod
Result Data Type: SETOF hdi_template
Argument Data Types: id bigint, template_xid bigint, template_name character varying, template_description character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    template_normalized_name VARCHAR;
    cnt BIGINT;
    result hdi_template;
BEGIN

    template_normalized_name := normalize(template_name);
    UPDATE hdi_template SET name = template_name, normalized_name = template_normalized_name,
            description = template_description, xid = xid_next(id)
        WHERE template_id = id AND state = 'ACTIVE' AND xid = template_xid RETURNING * INTO result;
    RETURN NEXT result;

EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'HDI TEMPLATE NAME CONFLICT : %', template_normalized_name;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: hdi_validate_ten_public_addr_config
Schema: pod
Result Data Type: void
Argument Data Types: dev_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    config hdi_config;
BEGIN
    -- only consider devices, not templates
    SELECT c.* FROM hdi_config c, hdi_device d WHERE c.resource_id = d.device_id AND d.device_id = dev_id INTO config;

    IF config.resource_id IS NOT NULL AND hdi_is_ten_public_addr_misconfigured(config) THEN
        RAISE EXCEPTION 'TEN PUBLIC ADDR MISCONFIGURED';
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: include_file
Schema: pod
Result Data Type: void
Argument Data Types: character varying
Volatility: volatile
Language: c
Source Code:
include_file
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: include_files
Schema: pod
Result Data Type: void
Argument Data Types: character varying, character varying
Volatility: volatile
Language: c
Source Code:
include_files
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_active
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE($1 = 'ACTIVE', FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_decommissioned
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE ($1 = 'DECOMMISSIONED', FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_in_service
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE($1 = 'READY' OR $1 = 'PROVISIONING_IN_PROGRESS' OR $1 = 'ACTIVE', FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_last_manager
Schema: pod
Result Data Type: boolean
Argument Data Types: fsid bigint, already_removed boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fs filesystem;
    manager_count INTEGER;
BEGIN
    shared_fs := filesystem_lookup_one(fsid);
    IF shared_fs.type = 'TEAM'::filesystem_type THEN
        SELECT count(*) FROM (SELECT * FROM shared_folder_membership WHERE fs_id = fsid 
                AND role = 'MANAGER'::shared_folder_membership_role 
                AND state NOT IN ('FORMER_MEMBER','FORMER_INVITEE') LIMIT 2) sfm 
            INTO manager_count;
        RETURN manager_count = (CASE WHEN already_removed THEN 0 ELSE 1 END);
    END IF;
    RETURN FALSE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_link_event
Schema: pod
Result Data Type: boolean
Argument Data Types: event version_event
Volatility: immutable
Language: sql
Source Code:

SELECT $1 IN ('READ_LINK_PRIV'::version_event, 'READ_LINK_ANON'::version_event,
              'UPLOAD_LINK_PRIV'::version_event, 'UPLOAD_LINK_ANON'::version_event,
              'CONFLICT_LINK_PRIV'::version_event, 'CONFLICT_LINK_ANON'::version_event);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_pre_service
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE($1 = 'AVAILABLE' OR $1 = 'RESERVED', FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_provisioning_allowed
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state, is_suspended boolean
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE(($1 = 'READY' OR $1 = 'PROVISIONING_IN_PROGRESS') AND $2 = FALSE, FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: is_ready
Schema: pod
Result Data Type: boolean
Argument Data Types: state hdi_device_state
Volatility: immutable
Language: sql
Source Code:

    SELECT COALESCE($1 = 'PROVISIONING_IN_PROGRESS' OR $1 = 'READY', FALSE);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_directory_entries
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, num_dir_entries numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    fs := filesystem_lookup_one($1);
    IF fs.type = 'EDP'::filesystem_type THEN
        SELECT assert_under_limit($2, edp_directory_entries, 'DIRECTORY ENTRY LIMIT') FROM limits INTO result;
    ELSE
        SELECT assert_under_limit($2, directory_entries, 'DIRECTORY ENTRY LIMIT') FROM limits INTO result;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_edp_devices
Schema: pod
Result Data Type: boolean
Argument Data Types: num_edp_devices numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, edp_devices, 'EDP DEVICES LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_entries
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, num_entries numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
  fs filesystem;
BEGIN
  fs := filesystem_lookup_one($1);
  IF fs.type = 'EDP'::filesystem_type THEN
      SELECT assert_under_limit($2, edp_entries, 'ENTRY LIMIT', $1::VARCHAR) FROM limits INTO result;
  ELSE
      SELECT assert_under_limit($2, entries, 'ENTRY LIMIT', $1::VARCHAR) FROM limits INTO result;
  END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_entry_name
Schema: pod
Result Data Type: boolean
Argument Data Types: entry_name character varying, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit(char_length($1), l.entry_name, 'ENTRY NAME LIMIT') FROM limits l
        INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_entry_name
Schema: pod
Result Data Type: void
Argument Data Types: entry_name character varying, thelimits limits
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
	PERFORM assert_under_limit(char_length($1), thelimits.entry_name, 'ENTRY NAME LIMIT');
END ;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_file_size
Schema: pod
Result Data Type: boolean
Argument Data Types: size bigint, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, file_size, 'FILE SIZE LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_devices_licensed
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_devices_licensed numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_devices_licensed, 'HDI DEVICES LICENSED LIMIT') FROM limits
        INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_devices_not_deleted
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_devices_not_deleted numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_devices_not_deleted, 'HDI DEVICES NOT DELETED LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_filesystems_per_device
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_filesystems_per_device numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_filesystems_per_device, 'HDI FILESYSTEMS PER DEVICE LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_nfs_shares_per_device
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_nfs_shares_per_device numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_nfs_shares_per_device, 'HDI NFS SHARES PER DEVICE LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_shares_per_filesystems
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_shares_per_filesystem numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_shares_per_filesystem, 'HDI SHARES PER FILESYSTEM LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_tags_in_system
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_tags_in_system numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_tags_in_system, 'HDI TAGS IN SYSTEM LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_tags_per_device
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_tags_per_device numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_tags_per_device, 'HDI TAGS PER DEVICE LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_hdi_templates
Schema: pod
Result Data Type: boolean
Argument Data Types: num_hdi_templates numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, hdi_templates, 'HDI TEMPLATE LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_joined_shared_folders
Schema: pod
Result Data Type: boolean
Argument Data Types: num_joined_shared_folders numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, joined_shared_folders, 'JOINED SHARED FOLDERS LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_mapi_user_clients
Schema: pod
Result Data Type: void
Argument Data Types: current_num_mapi_clients numeric, owner_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mapi_client_limits INTEGER;
    mapi_token_lifetime INTEGER;
    mapi_token_lifetime_config pod_config;
BEGIN
    mapi_client_limits := user_clients FROM limits;
    IF $1 &gt; mapi_client_limits THEN
        mapi_token_lifetime := 86400;
        mapi_token_lifetime_config := pod_config_lookup('mapi.token.lifetime.secs');
        IF mapi_token_lifetime_config IS NOT NULL THEN
            mapi_token_lifetime = to_number(mapi_token_lifetime_config.value, '999999999');
        END IF;
        DELETE FROM client WHERE user_id = $2 AND scope = 'MAPI'::client_scope AND
            last_access &lt; (now() - ((mapi_token_lifetime || ' seconds')::interval));
        PERFORM limit_user_clients(count + 1) FROM
           (SELECT COUNT(*) FROM client WHERE user_id = $2 AND scope = 'MAPI'::client_scope) AS c;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_mobilized_servers
Schema: pod
Result Data Type: boolean
Argument Data Types: num_mobilized_servers numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, mobilized_servers, 'MOBILIZED SERVER LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_owned_shared_folders
Schema: pod
Result Data Type: boolean
Argument Data Types: num_owned_shared_folders numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, owned_shared_folders, 'OWNED SHARED FOLDERS LIMIT')
        FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_path_length
Schema: pod
Result Data Type: boolean
Argument Data Types: length integer, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, path_length, 'PATH LENGTH LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_path_length
Schema: pod
Result Data Type: boolean
Argument Data Types: path character varying, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit(char_length($1), path_length, 'PATH LENGTH LIMIT') FROM limits
        INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_path_length
Schema: pod
Result Data Type: void
Argument Data Types: path character varying, thelimits limits
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    PERFORM assert_under_limit(char_length($1), thelimits.path_length, 'PATH LENGTH LIMIT');
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_profiles
Schema: pod
Result Data Type: boolean
Argument Data Types: num_profiles numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, profiles, 'PROFILE LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_update_int
Schema: pod
Result Data Type: numeric
Argument Data Types: limit_name character varying, new_limit numeric
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result NUMERIC;
BEGIN
    EXECUTE $q$ UPDATE limits SET $q$ || quote_ident(limit_name) || $q$ = $1 RETURNING $q$ || limit_name USING new_limit INTO result;
    PERFORM system_id_update(system_id_setting());
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_user_clients
Schema: pod
Result Data Type: boolean
Argument Data Types: num_users numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, user_clients, 'CLIENT LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_user_clients
Schema: pod
Result Data Type: boolean
Argument Data Types: user_id bigint, num_clients numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($2, effective_client_limit, 'CLIENT LIMIT') FROM user_lookup($1) INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limit_users
Schema: pod
Result Data Type: boolean
Argument Data Types: num_users numeric, OUT result boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT assert_under_limit($1, users, 'USER LIMIT') FROM limits INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: limits
Schema: pod
Result Data Type: limits
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM limits;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_cleanup
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT count(*) FROM link_cleanup_int();

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_cleanup_int
Schema: pod
Result Data Type: SETOF timestamp with time zone
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM link_share WHERE expiration &lt; transaction_timestamp() RETURNING expiration;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: link_create
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: user_id bigint, fs_id bigint, parent character varying, name character varying, expiration timestamp with time zone, public boolean, access_code character varying, permission link_share_permission, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result link_share;
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path($3, $4), true);
    IF NOT apply_directory_entry_filter(filter, resolved_path.fs_id, resolved_path.sync) THEN
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path($3, $4);
    END IF;

    INSERT INTO link_share(id, user_id, fs_id , path, expiration, public, access_code, permission, item_name) SELECT
        link_generate_id($1), $1, $2, full_path($3, $4), $5, $6, $7, $8, $4
        FROM directory_entry_lookup_latest($2, $3, $4, FALSE, FALSE, NULL::BIGINT,
             NULL::BIGINT, NULL::version_event, NULL::VARCHAR, TRUE, $9) RETURNING * INTO result;
    IF result.id IS NOT NULL THEN
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_delete
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: link_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM link_share WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_find
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM link_share WHERE id = $1 AND (expiration IS NULL OR expiration &gt;=
        transaction_timestamp());

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_generate_id
Schema: pod
Result Data Type: bigint
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT user_next_sub_id($1) | $1 | resource_type_link();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: link_list
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM link_share WHERE user_id = $1 AND (expiration IS NULL OR expiration &gt;= transaction_timestamp());

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_list_paged_backward
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: user_id bigint, page_size integer, token link_list_page_token, pattern character varying
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    locale_map VARCHAR;
    link_query VARCHAR;
    link_paging VARCHAR;
    link_order_by VARCHAR;
    full_query VARCHAR;
BEGIN
    locale_map := quote_ident(token.entry_collation);
    link_query := $q$ SELECT * FROM link_share AS link $q$;
    link_paging := $q$ WHERE user_id = $1 AND (expiration IS NULL OR expiration &gt;= transaction_timestamp()) AND
      (CASE WHEN $4 IS NOT NULL THEN link.item_name ILIKE '%' || $4 || '%' ELSE true END) $q$ ||
      CASE WHEN 'TYPE_EXPIRATION'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.expiration &lt; $3.last_expiration)
                OR ($3.last_expiration IS NOT NULL AND link.expiration IS NULL)
                OR (link.expiration = $3.last_expiration AND ((link.item_name &gt; $3.last_item_name)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_HAS_ACCESS_CODE'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR ($3.last_has_access_code IS FALSE AND link.access_code IS NOT NULL)
                OR (($3.last_has_access_code = (link.access_code IS NOT NULL)) AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$ )
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_PERMISSIONS'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.permission &lt; $3.last_permission)
                OR (link.permission = $3.last_permission AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_PUBLIC'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.public &lt; $3.last_public)
                OR (link.public = $3.last_public AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      ELSE
        $q$ AND (($3.last_id IS NULL
                OR (link.item_name &lt; $3.last_item_name COLLATE $q$ || locale_map || $q$ )
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id))) $q$
      END;
    link_order_by := $q$ ORDER BY $q$ ||
      CASE WHEN 'TYPE_EXPIRATION'::paged_link_list_order = token.ordering THEN
        $q$ expiration DESC NULLS LAST, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_HAS_ACCESS_CODE'::paged_link_list_order = token.ordering THEN
        $q$ access_code IS NULL DESC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_PERMISSIONS'::paged_link_list_order = token.ordering THEN
        $q$ permission DESC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_PUBLIC'::paged_link_list_order = token.ordering THEN
        $q$ public DESC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      ELSE
        $q$ item_name COLLATE $q$ || locale_map || $q$ DESC, id ASC $q$
      END;
    full_query := link_query || link_paging || link_order_by || ' LIMIT $2';
    RETURN QUERY EXECUTE (full_query)
        USING $1, $2, $3, $4;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_list_paged_forward
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: user_id bigint, page_size integer, token link_list_page_token, pattern character varying
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
  locale_map VARCHAR;
  link_query VARCHAR;
  link_paging VARCHAR;
  link_order_by VARCHAR;
  full_query VARCHAR;
BEGIN
    locale_map := quote_ident(token.entry_collation);
    link_query := $q$ SELECT * FROM link_share AS link $q$;
    link_paging := $q$ WHERE user_id = $1 AND (expiration IS NULL OR expiration &gt;= transaction_timestamp()) AND
      (CASE WHEN $4 IS NOT NULL THEN link.item_name ILIKE '%' || $4 || '%' ELSE true END) $q$ ||
      CASE WHEN 'TYPE_EXPIRATION'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.expiration &gt; $3.last_expiration)
                OR ($3.last_expiration IS NULL AND link.expiration IS NOT NULL)
                OR (link.expiration = $3.last_expiration AND ((link.item_name &gt; $3.last_item_name)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_HAS_ACCESS_CODE'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR ($3.last_has_access_code IS TRUE AND link.access_code IS NULL)
                OR (($3.last_has_access_code = (link.access_code IS NOT NULL)) AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_PERMISSIONS'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.permission &gt; $3.last_permission)
                OR (link.permission = $3.last_permission AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      WHEN 'TYPE_PUBLIC'::paged_link_list_order = token.ordering THEN
        $q$ AND (($3.last_id IS NULL)
                OR (link.public &gt; $3.last_public)
                OR (link.public = $3.last_public AND ((link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$)
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)))) $q$
      ELSE
        $q$ AND (($3.last_id IS NULL)
                OR (link.item_name &gt; $3.last_item_name COLLATE $q$ || locale_map || $q$ )
                OR (link.item_name = $3.last_item_name AND link.id &gt; $3.last_id)) $q$
      END;
    link_order_by := $q$ ORDER BY $q$ ||
      CASE WHEN 'TYPE_EXPIRATION'::paged_link_list_order = token.ordering THEN
        $q$ expiration ASC NULLS FIRST, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_HAS_ACCESS_CODE'::paged_link_list_order = token.ordering THEN
        $q$ access_code IS NULL ASC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_PERMISSIONS'::paged_link_list_order = token.ordering THEN
        $q$ permission ASC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      WHEN 'TYPE_PUBLIC'::paged_link_list_order = token.ordering THEN
        $q$ public ASC, item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      ELSE
        $q$ item_name COLLATE $q$ || locale_map || $q$ ASC, id ASC $q$
      END;
    full_query := link_query || link_paging || link_order_by || ' LIMIT $2';
    RETURN QUERY EXECUTE (full_query)
         USING $1, $2, $3, $4;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_list_path
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: fs_id bigint, path character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM link_share WHERE fs_id = $1 AND path = $2 AND (expiration IS NULL OR expiration &gt;= transaction_timestamp());

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_lookup
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: id bigint, public boolean
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM link_share WHERE id = $1 AND public = $2 AND (expiration IS NULL OR expiration &gt;=
        transaction_timestamp());

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_update
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: link_id bigint, access_code character varying, expiration timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    UPDATE link_share SET access_code=$2, expiration = $3 WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_update_access_code
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: link_id bigint, access_code character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE link_share SET access_code = $2 WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: link_update_expiration
Schema: pod
Result Data Type: SETOF link_share
Argument Data Types: link_id bigint, expiration timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    UPDATE link_share SET expiration = $2 WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: log_terse
Schema: pod
Result Data Type: void
Argument Data Types: message text
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    old_verbosity text;
    old_min text;
BEGIN
    show log_error_verbosity INTO old_verbosity;
    SET log_error_verbosity = TERSE;
    show log_min_error_statement INTO old_min;
    SET log_min_error_statement = PANIC;
    RAISE LOG '%', message;
    EXECUTE $q$ SET log_error_verbosity = $q$ || old_verbosity;
    EXECUTE $q$ SET log_min_error_statement = $q$ || old_min;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: log_upgrade_msg
Schema: pod
Result Data Type: void
Argument Data Types: message text
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    old_setting text;
BEGIN
    show log_error_verbosity INTO old_setting;
    SET log_error_verbosity = TERSE;
    RAISE LOG 'Upgrade: %', message;
    EXECUTE $q$ SET log_error_verbosity = $q$ || old_setting;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_constant
Schema: pod
Result Data Type: void
Argument Data Types: name text, const anyelement
Volatility: volatile
Language: sql
Source Code:

    SELECT make_variable($1, $2, 'IMMUTABLE');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_sequence
Schema: pod
Result Data Type: void
Argument Data Types: name text, max bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT make_sequence($1, 1, $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_sequence
Schema: pod
Result Data Type: void
Argument Data Types: name text, min bigint, max bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $$ CREATE SEQUENCE $$ || name || $$ MINVALUE $$ || min || $$ MAXVALUE $$ || max || $$;$$;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_stable_var
Schema: pod
Result Data Type: void
Argument Data Types: name text, const anyelement
Volatility: volatile
Language: sql
Source Code:

    SELECT make_variable($1, $2, 'STABLE');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_sub_id_sequence
Schema: pod
Result Data Type: void
Argument Data Types: name text
Volatility: volatile
Language: sql
Source Code:

    SELECT make_sequence($1, resource_mask_sub_id());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: make_variable
Schema: pod
Result Data Type: void
Argument Data Types: name text, const anyelement, volatility text
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    const_type TEXT;
BEGIN
    const_type := pg_typeof(const);
    EXECUTE $constfunc$
        CREATE OR REPLACE FUNCTION $constfunc$ || name || $constfunc$() 
        RETURNS $constfunc$ || const_type || $constfunc$  AS $$
            SELECT '$constfunc$ || const || $constfunc$'::$constfunc$ || const_type || $constfunc$;
        $$ LANGUAGE SQL $constfunc$ || volatility || $constfunc$;
    $constfunc$;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mapi_client_under_limit
Schema: pod
Result Data Type: void
Argument Data Types: owner_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT limit_mapi_user_clients(count + 1, $1) FROM
        (SELECT COUNT(*) FROM client WHERE user_id = $1 AND scope = 'MAPI'::client_scope) AS c;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_client_insert
Schema: pod
Result Data Type: SETOF metrics_client
Argument Data Types: limit_seconds integer
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO metrics_client(metric_date, user_connections, client_connections)
        SELECT transaction_timestamp(), user_count, client_count
            FROM client_connected_counts($1) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_client_latest
Schema: pod
Result Data Type: SETOF metrics_client
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_client ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_client_lookup
Schema: pod
Result Data Type: SETOF metrics_client
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_client WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_edp_insert
Schema: pod
Result Data Type: SETOF metrics_edp
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

	INSERT INTO metrics_edp(metric_date, edp_active_devices_count, edp_disassociated_devices_count,
		edp_total_files, edp_total_file_size)
	SELECT transaction_timestamp(), edp_active_devices_count, edp_disassociated_devices_count,
		edp_total_files, edp_total_file_size FROM edp_metrics() RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_edp_latest
Schema: pod
Result Data Type: SETOF metrics_edp
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

	SELECT * FROM metrics_edp ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_edp_lookup
Schema: pod
Result Data Type: SETOF metrics_edp
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

	SELECT * FROM metrics_edp WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_fss_usage_insert
Schema: pod
Result Data Type: metrics_fss_usage
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    priv_link BIGINT := 0;
    pub_link BIGINT := 0;
    cur_tot_files BIGINT := 0;
    cur_tot_file_size BIGINT := 0;
    unchunked_tot_files BIGINT := 0;
    unchunked_tot_file_size BIGINT := 0;
    phys_tot_files BIGINT := 0;
    phys_tot_file_size BIGINT := 0;
    link_public BOOLEAN;
    link_count BIGINT;
    result metrics_fss_usage;
BEGIN
    FOR link_public, link_count IN select public, count(*) from link_share group by public LOOP
        IF link_public THEN
            pub_link := link_count;
        ELSE
            priv_link := link_count;
        END IF;
    END LOOP;

    SELECT COALESCE(SUM(file_count), 0), COALESCE(SUM(sum_file_size), 0) FROM filesystem 
        INTO cur_tot_files, cur_tot_file_size;

    SELECT COALESCE(SUM(refcount), 0), COALESCE(SUM(size * refcount), 0), count(*), COALESCE(SUM(size), 0) 
        FROM visible_object
        INTO unchunked_tot_files, unchunked_tot_file_size, phys_tot_files, phys_tot_file_size;

    INSERT INTO metrics_fss_usage(metric_date, private_links, public_links,
                                       current_total_files, current_total_file_size,
                                       all_total_files, all_total_file_size,
                                       physical_total_files, physical_total_file_size)
        SELECT transaction_timestamp(), priv_link, pub_link, 
               cur_tot_files, cur_tot_file_size,
               unchunked_tot_files, unchunked_tot_file_size,
               phys_tot_files, phys_tot_file_size
        RETURNING * INTO result;
    RETURN result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_fss_usage_latest
Schema: pod
Result Data Type: SETOF metrics_fss_usage
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_fss_usage ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_fss_usage_lookup
Schema: pod
Result Data Type: SETOF metrics_fss_usage
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_fss_usage WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_mobilization_insert
Schema: pod
Result Data Type: SETOF metrics_mobilization
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO metrics_mobilization(metric_date, server_count, static_share_count, 
        dynamic_share_count, dynamic_filesystem_count) 
    SELECT transaction_timestamp(), mobilized_server_count, mobilized_static_share_count,
        mobilized_dynamic_share_count, mobilized_dynamic_filesystem_count 
        FROM mobilization_metrics() RETURNING *; 

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_mobilization_latest
Schema: pod
Result Data Type: SETOF metrics_mobilization
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_mobilization ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_mobilization_lookup
Schema: pod
Result Data Type: SETOF metrics_mobilization
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_mobilization WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_namespace_insert
Schema: pod
Result Data Type: metrics_namespace
Argument Data Types: in_metric_date timestamp with time zone, in_owner namespace_owner, in_total_space bigint, in_used_space bigint, in_objects bigint, in_objects_size bigint, in_num_reads bigint, in_num_writes bigint, in_num_deletes bigint, in_bytes_read bigint, in_bytes_written bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result metrics_namespace;
BEGIN
    -- Try to update first if that fails insert
    -- If the insert fails loop through again and update
    LOOP
        UPDATE metrics_namespace
            SET total_space = in_total_space, used_space = in_used_space,
                objects = in_objects, objects_size = in_objects_size, num_reads = in_num_reads,
                num_writes = in_num_writes, num_deletes = in_num_deletes, bytes_read = in_bytes_read,
                bytes_written = in_bytes_written
            WHERE metric_date = in_metric_date AND owner = in_owner
            RETURNING * INTO result;
        IF result.metric_date IS NOT NULL THEN
            RETURN result;
        END IF;
        BEGIN 
	        INSERT INTO metrics_namespace(metric_date, owner, total_space, used_space, objects,
	                    objects_size, num_reads, num_writes, num_deletes, bytes_read, bytes_written)
	            VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) RETURNING * INTO result;
            RETURN result;
        EXCEPTION WHEN unique_violation THEN -- Loop again
        END;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_namespace_latest
Schema: pod
Result Data Type: SETOF metrics_namespace
Argument Data Types: owner namespace_owner
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_namespace WHERE owner = $1 ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_namespace_lookup
Schema: pod
Result Data Type: SETOF metrics_namespace
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_namespace WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_namespace_lookup
Schema: pod
Result Data Type: SETOF metrics_namespace
Argument Data Types: since timestamp with time zone, owner namespace_owner
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_namespace WHERE metric_date &gt; $1 AND owner = $2
        ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_prune
Schema: pod
Result Data Type: boolean
Argument Data Types: before timestamp with time zone
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM metrics_namespace WHERE metric_date &lt; $1;
    DELETE FROM metrics_client WHERE metric_date &lt; $1;
    DELETE FROM metrics_remote WHERE metric_date &lt; $1;
    DELETE FROM metrics_shared_folder WHERE metric_date &lt; $1;
    DELETE FROM metrics_mobilization WHERE metric_date &lt; $1;
    DELETE FROM metrics_fss_usage WHERE metric_date &lt; $1;
    DELETE FROM metrics_team_folder WHERE metric_date &lt; $1;
    DELETE FROM metrics_edp WHERE metric_date &lt; $1;
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_remote_insert
Schema: pod
Result Data Type: SETOF metrics_remote
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO metrics_remote(metric_date, device_total, device_inventory, device_in_service,
                               device_out_service)
        SELECT transaction_timestamp(), total, inventory, in_service, out_service
            FROM hdi_device_metrics_count() RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_remote_latest
Schema: pod
Result Data Type: SETOF metrics_remote
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_remote ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_remote_lookup
Schema: pod
Result Data Type: SETOF metrics_remote
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_remote WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_shared_folder_insert
Schema: pod
Result Data Type: SETOF metrics_shared_folder
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO metrics_shared_folder(metric_date, shared_folder_count, membership_count, 
                                      current_total_files, current_total_file_size)
        SELECT transaction_timestamp(), sf_count, sf_membership_count, sf_tot_files, sf_tot_file_size
            FROM sf_shared_folder_metrics() RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_shared_folder_latest
Schema: pod
Result Data Type: SETOF metrics_shared_folder
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_shared_folder ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_shared_folder_lookup
Schema: pod
Result Data Type: SETOF metrics_shared_folder
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_shared_folder WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_team_folder_insert
Schema: pod
Result Data Type: SETOF metrics_team_folder
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO metrics_team_folder(metric_date, team_folder_count, team_folder_members, 
        team_folder_capacity, team_folder_reserved, team_folder_usage, team_folder_file_count, 
        team_folder_abandoned_count, team_folder_abandoned_usage) 
    SELECT transaction_timestamp(), team_folder_count, team_folder_members, team_folder_capacity,
        team_folder_reserved, team_folder_usage, team_folder_file_count, 
        team_folder_abandoned_count, team_folder_abandoned_usage FROM team_folder_metrics() 
            RETURNING *; 

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_team_folder_latest
Schema: pod
Result Data Type: SETOF metrics_team_folder
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_team_folder ORDER BY metric_date DESC LIMIT 1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_team_folder_lookup
Schema: pod
Result Data Type: SETOF metrics_team_folder
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_team_folder WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_tenant_insert
Schema: pod
Result Data Type: metrics_tenant
Argument Data Types: in_metric_date timestamp with time zone, in_total_space bigint, in_space_allocated bigint, in_space_used bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result metrics_tenant;
BEGIN
    -- Try to update first if that fails insert
    -- If the insert fails loop through again and update
    LOOP
        UPDATE metrics_tenant
            SET total_space = in_total_space, space_allocated = in_space_allocated,
                space_used = in_space_used
            WHERE metric_date = in_metric_date RETURNING * INTO result;
        IF result.metric_date IS NOT NULL THEN
            RETURN result;
        END IF;
        
        BEGIN
		    INSERT INTO metrics_tenant(metric_date, total_space, space_allocated, space_used)
		        VALUES ($1, $2, $3, $4) RETURNING * INTO result;
            RETURN result;
        EXCEPTION WHEN unique_violation THEN -- Loop again
        END;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: metrics_tenant_lookup
Schema: pod
Result Data Type: SETOF metrics_tenant
Argument Data Types: since timestamp with time zone
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM metrics_tenant WHERE metric_date &gt; $1 ORDER BY metric_date;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mk_path
Schema: pod
Result Data Type: character varying
Argument Data Types: object_id bigint
Volatility: volatile
Language: c
Source Code:
mk_path
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mob_fs_func_schema
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT 'mob_fs_func_v'::character varying;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mob_fs_func_schema_exists
Schema: pod
Result Data Type: boolean
Argument Data Types: version bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    func_schema TEXT;
BEGIN
    func_schema := mob_fs_func_schema() || version;
    RETURN EXISTS (SELECT schema_name FROM information_schema.schemata
                    WHERE schema_name = func_schema);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mob_fs_func_schema_set
Schema: pod
Result Data Type: void
Argument Data Types: version bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE 'SET SEARCH_PATH TO ' || mob_fs_func_schema() || version || ','
        || fsid_to_schema(version) || ',pod,public';
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_activity_archive_list
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: filesystem_id bigint, archive_age timestamp with time zone, last_version_id bigint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_fs(filesystem_id);
    IF last_version_id IS NULL THEN
        last_version_id = 0;
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT * FROM activity_archive_list($1, $2, $3)
        $q$ USING archive_age, last_version_id, max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_archive_begin_delete
Schema: pod
Result Data Type: void
Argument Data Types: share_id bigint, archive_age timestamp with time zone, archive_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM mobilized_share_update_archive(share_id, archive_age, archive_size, TRUE);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_archive_complete_delete
Schema: pod
Result Data Type: void
Argument Data Types: share_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    UPDATE mobilized_share SET need_delete = FALSE, xid = xid_next(mobilized_share_id)
        WHERE mobilized_share_id = share_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_archive_delete_before_dynamic
Schema: pod
Result Data Type: bigint
Argument Data Types: share_id bigint, archive_age timestamp with time zone, last_fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    FOR fs IN SELECT * FROM mobilization_list_filesystems(share_id, last_fs_id) LOOP
        PERFORM set_path_wlock_fs(fs.fs_id);
        EXECUTE $q$ SELECT * FROM archive_delete_before($1) $q$ USING archive_age;
        -- drop filesystem, mark it deleted - if it's inactive and empty
        PERFORM archive_empty_filesystem(fs.fs_id);
    END LOOP;
    RETURN fs.fs_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_archive_delete_before_static
Schema: pod
Result Data Type: void
Argument Data Types: share_id bigint, archive_age timestamp with time zone, archive_size bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
BEGIN
    -- There should only be one filesystem
    FOR fs IN
        SELECT * FROM mobilization_list_all_filesystems(share_id) LOOP
        PERFORM set_path_wlock_fs(fs.fs_id);
        EXECUTE $q$ SELECT * FROM archive_delete_before($1) $q$ USING archive_age;
        -- drop filesystem, mark it deleted - if it's inactive and empty
        PERFORM archive_empty_filesystem(fs.fs_id);
    END LOOP;
    PERFORM mobilized_share_update_archive(share_id, archive_age, archive_size, FALSE);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_list_all_filesystems
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: share_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM filesystem WHERE owner_id = share_id ORDER BY fs_id;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_list_filesystems
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: share_id bigint, last_fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM filesystem 
        WHERE owner_id = share_id 
        AND fs_id &gt; coalesce(last_fs_id, 0)
        ORDER BY fs_id
        LIMIT 100;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_list_mounted_shares
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT mobilized_share_lookup_for_filesystem(mf.fs_id) 
        FROM sf_lookup_all_joined_shared_folders($1, FALSE, FALSE) mf 
            WHERE fs_is_mobilized(mf.type);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_list_new_mounted_shares
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: user_id bigint, latest_mobilized_mtime timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT mf.* FROM sf_lookup_new_joined_shared_folders(user_id, FALSE,  
        latest_mobilized_mtime) mf WHERE fs_is_mobilized(mf.type);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_lookup_folders_under_path
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, path character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM sf_lookup_joined_shared_folders_under_path(userid, path) 
        WHERE fs_is_mobilized(type);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilization_metrics
Schema: pod
Result Data Type: record
Argument Data Types: OUT mobilized_server_count bigint, OUT mobilized_static_share_count bigint, OUT mobilized_dynamic_share_count bigint, OUT mobilized_dynamic_filesystem_count bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT count(*) FROM mobilized_server WHERE state = 'ACTIVE' INTO mobilized_server_count;
    SELECT count(*) FROM mobilized_share WHERE type = 'STATIC' AND state = 'ACTIVE' 
        INTO mobilized_static_share_count;
    SELECT count(*) FROM mobilized_share WHERE type = 'DYNAMIC' AND state = 'ACTIVE' 
        INTO mobilized_dynamic_share_count;
    SELECT count(*) FROM mobilized_share ms, mobilized_share_user_filesystem msuf 
        WHERE ms.state = 'ACTIVE' AND ms.type = 'DYNAMIC' 
            AND ms.mobilized_share_id = msuf.mobilized_share_id 
        INTO mobilized_dynamic_filesystem_count;
END 

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_directory_delete
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, parent_path character varying, dir_name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    result BOOLEAN;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, dir_name), false);
    EXECUTE $q$ SELECT TRUE FROM mobilized_delete($3, $4, $5, $6) $q$ USING resolved_path.fs_id,
        resolved_path.mountpoint_path, resolved_path.parent, resolved_path.name, client_id,
        'FILE'::entry_type INTO result;
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_directory_rename
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, src_parent_path character varying, src_name character varying, dest_parent_path character varying, dest_name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(src_parent_path, src_name), false);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM mobilized_rename($3, $4,
                                $5, $6, $7, $8) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
              resolved_path.name, dest_parent_path, dest_name, client_id, 'DIRECTORY'::entry_type;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_file_delete
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    result BOOLEAN;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    EXECUTE $q$ SELECT TRUE FROM mobilized_delete($3, $4, $5, $6) $q$ USING resolved_path.fs_id,
            resolved_path.mountpoint_path, resolved_path.parent, resolved_path.name, client_id,
            'FILE'::entry_type INTO result;
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_file_overwrite
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, client_id bigint, mtime timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM mobilized_file_write($3, $4,
                                $5, $6, $7) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
              resolved_path.name, client_id, mtime, 'UPDATE'::version_event;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_file_read
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent character varying, name character varying, client_id bigint, event version_event, args character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent, name), false);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM
            (SELECT unresolve_path($1, $2, d) up
                FROM mobilized_file_read($3, $4, $5, $6, $7) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
                resolved_path.name, client_id, event, args;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_file_rename
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, src_parent_path character varying, src_name character varying, dest_parent_path character varying, dest_name character varying, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(src_parent_path, src_name), false);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM mobilized_rename($3, $4,
                                $5, $6, $7, $8) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
              resolved_path.name, dest_parent_path, dest_name, client_id, 'FILE'::entry_type;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_file_write_new
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fs_id bigint, parent_path character varying, file_name character varying, client_id bigint, mtime timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
BEGIN
    resolved_path := resolve_path_wlock(fs_id, full_path(parent_path, file_name), false);
    RETURN QUERY EXECUTE $q$
        SELECT (q.up).* FROM (SELECT unresolve_path($1, $2, d) up FROM mobilized_file_write($3, $4,
                                $5, $6, $7) d) AS q
    $q$ USING client_id, resolved_path, resolved_path.parent,
              resolved_path.name, client_id, mtime, 'CREATE'::version_event;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_create
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: host character varying, label character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM limit_mobilized_servers(count(*) + 1) FROM mobilized_server_list();
    RETURN QUERY INSERT INTO mobilized_server(mobilized_server_id, state, host, label, xid) 
        VALUES (mobilized_server_next_id(), 'ACTIVE'::mobilized_server_state, $1, $2, 1) RETURNING *;
EXCEPTION
    WHEN unique_violation THEN
        RAISE EXCEPTION 'DUPLICATE SERVER LABEL';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_delete
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: mobilized_server_id bigint, xid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, ($2 + 1)::TEXT);
    RETURN QUERY UPDATE mobilized_server AS ms SET state = 'DELETED'::mobilized_server_state, 
        xid = ms.xid + 1 WHERE ms.mobilized_server_id = $1 AND ms.xid = $2 
        AND ms.state = 'ACTIVE'::mobilized_server_state RETURNING *;
    PERFORM mobilized_share_delete(msh.mobilized_share_id, msh.xid) 
        FROM mobilized_share msh
        WHERE msh.mobilized_server_id = $1 AND msh.state = 'ACTIVE'::mobilized_share_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_list
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- need paging? I hope not, shouldn't be many of these.
    RETURN QUERY SELECT * from mobilized_server WHERE state = 'ACTIVE'::mobilized_server_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_lookup
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: mobilized_server_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * from mobilized_server AS ms 
        WHERE ms.mobilized_server_id = $1 AND ms.state = 'ACTIVE'::mobilized_server_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_lookup_rlock
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: mobilized_server_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * from mobilized_server AS ms 
        WHERE ms.mobilized_server_id = $1 AND ms.state = 'ACTIVE'::mobilized_server_state 
        FOR SHARE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('mobilized_server_id_seq') | resource_type_mobilized_server();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_server_update
Schema: pod
Result Data Type: SETOF mobilized_server
Argument Data Types: mobilized_server_id bigint, host character varying, xid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, ($3 + 1)::TEXT);
    RETURN QUERY UPDATE mobilized_server AS ms SET host = $2, xid = ms.xid + 1 
        WHERE ms.mobilized_server_id = $1 AND ms.xid = $3 
        AND ms.state = 'ACTIVE'::mobilized_server_state RETURNING *;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_clear_optimize
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE mobilized_share SET need_optimize = FALSE, xid = xid_next(mobilized_share_id)
        WHERE mobilized_share_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_create
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: mobilized_server_id bigint, type mobilized_share_type, path character varying, label character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mobilized_share_id BIGINT;
    existing_share mobilized_share;
    server mobilized_server;
    result mobilized_share;
    fs_id BIGINT;
BEGIN
    SELECT * FROM mobilized_server_lookup_rlock($1) INTO server;
    if server.mobilized_server_id IS NOT NULL THEN
        mobilized_share_id := mobilized_share_next_id();
        fs_id := CASE WHEN $2 = 'STATIC'::mobilized_share_type THEN fs_next_cifs_static_id() 
            ELSE NULL END;
        PERFORM create_filesystem(fs_id, mobilized_share_id, 'CIFS_STATIC'::filesystem_type, 
            label, client_gen_id(user_admin_id(), client_portal_sub_id())) 
            WHERE type = 'STATIC'::mobilized_share_type;
        INSERT INTO mobilized_share(mobilized_share_id, mobilized_server_id, type, state, path, 
                                    label, fs_id, xid) 
            VALUES (mobilized_share_id, $1, $2, 'ACTIVE'::mobilized_share_state, $3, $4, fs_id, 1) 
            RETURNING * INTO result;
        RETURN NEXT result;
    ELSE
        RAISE EXCEPTION 'NO SUCH MOBILIZED SERVER: %', $1 ;
    END IF;
EXCEPTION
    WHEN unique_violation THEN
        RAISE EXCEPTION 'DUPLICATE SHARE LABEL';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_delete
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: mobilized_share_id bigint, xid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result mobilized_share;
BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, ($2 + 1)::TEXT);
    UPDATE mobilized_share AS ms SET state = 'DELETED'::mobilized_share_state, xid = ms.xid + 1
        WHERE ms.mobilized_share_id = $1 AND ms.xid = $2 
        AND ms.state = 'ACTIVE'::mobilized_share_state RETURNING * INTO result;
    IF result.mobilized_share_id IS NOT NULL THEN
        PERFORM filesystem_mark_inactive(result.fs_id) WHERE result.type = 'STATIC'::mobilized_share_type;
        PERFORM filesystem_mark_inactive(msuf.fs_id) FROM mobilized_share_user_filesystem AS msuf 
            WHERE result.type = 'DYNAMIC'::mobilized_share_type AND msuf.mobilized_share_id = $1;
        PERFORM pgq.insert_event('async_task', 'PROFILE_MOBILIZED_SHARE_REMOVAL', 
            cast(mobilized_share_id AS text));
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_find_mount_share_filesystem
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: mobilized_share_id bigint, user_id bigint, create_fs boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    share mobilized_share;
    owner user_account;
    mobilized_filesystem filesystem;
    private_fs filesystem;
    path VARCHAR;
BEGIN
    SELECT * FROM set_path_wlock_private_fs(user_id) INTO private_fs;
    IF private_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(private_fs);
        SELECT * FROM set_path_wlock_private_fs(user_id) INTO private_fs;
    END IF;
    SELECT * FROM mobilized_share_lookup_read_lock(mobilized_share_id, FALSE) INTO share;
    IF share.mobilized_share_id IS NOT NULL THEN 
        SELECT * FROM mobilized_share_get_filesystem(user_id, share, create_fs) 
            INTO mobilized_filesystem;
        IF mobilized_filesystem.fs_id IS NOT NULL THEN 
            IF create_fs THEN
                PERFORM set_path_to_fs(private_fs);
                EXECUTE $q$ SELECT * FROM directory_create_mountpoint($1, '/', $2, $3, FALSE) $q$ 
                    USING mobilized_filesystem.fs_id, share.label, 
                    client_gen_id(user_id, client_portal_sub_id()) INTO path;
            ELSE
                PERFORM set_path_to_fs(private_fs);
                EXECUTE $q$SELECT directory_lookup_mounted_path($1)$q$ INTO path 
                    USING mobilized_filesystem.fs_id;
            END IF; 
            RETURN QUERY EXECUTE $q$ SELECT f.*, $1, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role FROM filesystem f, 
                directories_lookup_mountpoints($2, FALSE) mp WHERE f.state = 'ACTIVE'
                    AND (f.type = 'CIFS_STATIC' OR f.type = 'CIFS_DYNAMIC') 
                    AND f.fs_id = mp.fs_id $q$ USING user_id, path;
        ELSE
            -- create_fs must have been false and no such filesystem existed. throw this to be
            -- consistent with when a static share isn't mounted
            RAISE EXCEPTION 'FILESYSTEM MOUNT POINT NOT FOUND';
        END IF;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_get_filesystem
Schema: pod
Result Data Type: filesystem
Argument Data Types: user_id bigint, share mobilized_share, create_fs boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_id BIGINT;
    existing mobilized_share_user_filesystem;
    result filesystem;
BEGIN
    IF share.type = 'DYNAMIC'::mobilized_share_type THEN
        SELECT * FROM mobilized_share_user_filesystem AS msuf
            WHERE msuf.mobilized_share_id = share.mobilized_share_id AND msuf.user_id = $1 
            INTO existing;
        IF existing.mobilized_share_id IS NULL AND create_fs THEN
            fs_id := fs_next_cifs_dynamic_id();
            PERFORM create_filesystem(fs_id, share.mobilized_share_id, 
                                      'CIFS_DYNAMIC'::filesystem_type, share.label, 
                                      client_gen_id(user_id, client_portal_sub_id()));
            INSERT INTO mobilized_share_user_filesystem(mobilized_share_id, user_id, fs_id) 
                VALUES (share.mobilized_share_id, $1, fs_id);
        ELSE
            fs_id := existing.fs_id;
        END IF;
    ELSIF share.type = 'STATIC'::mobilized_share_type THEN
        fs_id := share.fs_id;
    END IF;
    SELECT * FROM filesystem_lookup_one(fs_id) INTO result; 
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_list_for_archive
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: before_timestamp timestamp with time zone, last_share_id bigint, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM mobilized_share
        WHERE mobilized_share_id &gt; $2 AND (archive_timestamp IS NULL OR archive_timestamp &lt; $1)
        ORDER BY mobilized_share_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_list_for_optimize
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: last_share_id bigint, max integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF last_share_id IS NULL THEN
        last_share_id = 0;
    END IF;
    RETURN QUERY SELECT * FROM mobilized_share AS ms 
        WHERE ms.mobilized_share_id &gt; last_share_id AND ms.need_optimize
        ORDER BY mobilized_share_id
        LIMIT max;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_list_for_server
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: mobilized_server_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- TODO: this should probably be paged, as we may have many shares for a given server
    RETURN QUERY SELECT * FROM mobilized_share AS ms 
        WHERE ms.mobilized_server_id = $1 AND ms.state = 'ACTIVE'::mobilized_share_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_lookup
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: mobilized_share_id bigint, include_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM mobilized_share AS ms 
        WHERE ms.mobilized_share_id = $1 AND (include_deleted 
            OR ms.state = 'ACTIVE'::mobilized_share_state);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_lookup_for_filesystem
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: fs_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM mobilized_share AS ms WHERE ms.fs_id = $1;
    RETURN QUERY SELECT ms.* FROM mobilized_share AS ms, mobilized_share_user_filesystem AS msuf
        WHERE msuf.fs_id = $1 AND msuf.mobilized_share_id = ms.mobilized_share_id; 
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_lookup_read_lock
Schema: pod
Result Data Type: SETOF mobilized_share
Argument Data Types: mobilized_share_id bigint, include_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM mobilized_share AS ms 
        WHERE ms.mobilized_share_id = $1 AND (include_deleted 
            OR ms.state = 'ACTIVE'::mobilized_share_state) FOR SHARE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('mobilized_share_id_seq') | resource_type_mobilized_share();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_unmount_for_user
Schema: pod
Result Data Type: boolean
Argument Data Types: user_id bigint, mobilized_share_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    share mobilized_share;
    mobilized_filesystem filesystem;
BEGIN
    PERFORM set_path_wlock_private_fs(user_id);
    SELECT * FROM mobilized_share_lookup_read_lock(mobilized_share_id, TRUE) INTO share;
    SELECT * FROM mobilized_share_get_filesystem(user_id, share, FALSE) INTO mobilized_filesystem;
    IF mobilized_filesystem.fs_id IS NOT NULL THEN
        EXECUTE $q$ SELECT directory_delete_mountpoint_to_fs($1, $2) $q$ 
            USING mobilized_filesystem.fs_id, client_gen_id(user_id, client_portal_sub_id());
        RETURN TRUE;
    END IF;
    RETURN FALSE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: mobilized_share_update_archive
Schema: pod
Result Data Type: void
Argument Data Types: share_id bigint, archive_age timestamp with time zone, archive_size bigint, need_delete boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE mobilized_share
        SET archive_timestamp = $2, archive_space = coalesce(archive_space, 0) + $3,
            need_optimize = ($3 &gt; 0), need_delete = need_delete OR $4,
            xid = xid_next(mobilized_share_id)
        WHERE mobilized_share_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_clear_owner_passwords_for_hdi_device
Schema: pod
Result Data Type: void
Argument Data Types: hdi_device_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET need_password = namespace_queue_password(namespace_id), xid = xid_next($1)
        WHERE namespace_id IN (SELECT namespace_id FROM hdi_local_filesystem WHERE resource_id = $1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_clear_passwords
Schema: pod
Result Data Type: void
Argument Data Types: namespace_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET need_password = namespace_queue_password($1), need_ro_password = TRUE, 
            xid = xid_next($1)
        WHERE namespace_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_clear_read_only_password
Schema: pod
Result Data Type: void
Argument Data Types: namespace_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET need_ro_password = namespace_queue_password($1), xid = xid_next($1)
        WHERE namespace_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_create
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: name character varying, description character varying, tenant_id bigint, namespace_owner namespace_owner, username character varying, password character varying, ro_username character varying, ro_password character varying, total_space bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT add_tenant_use($3, $4);
    INSERT INTO namespace (namespace_id, name, description, tenant_id, namespace_owner, username,
                           password, read_only_username, read_only_password, total_space, space_used,
                           object_count, initial_space, creation_time, xid)
        (SELECT namespace_next_id, $1, $2, $3, $4, $5, $6, $7, $8, $9, 0, 0, $9, now(), xid_next(namespace_next_id)
            FROM namespace_next_id()) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_delete
Schema: pod
Result Data Type: bigint
Argument Data Types: namespace_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM namespace WHERE namespace_id = $1 RETURNING xid_next($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_find
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: pattern character varying, max integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE name LIKE $1 || '%' ORDER BY NAME LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_get_max_percent_used
Schema: pod
Result Data Type: integer
Argument Data Types: ns_owner namespace_owner
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    owner_clause VARCHAR := '';
    query_str VARCHAR;
    result BIGINT;
BEGIN

    IF ns_owner IS NOT NULL THEN
       owner_clause := $b$ AND namespace_owner = '$b$ || ns_owner || $c$'$c$;
    END IF;

    query_str := 'SELECT coalesce((SELECT MAX(percent_used) FROM namespace WHERE is_orphaned = FALSE'
        || owner_clause || '), 0)';
    --RAISE notice 'Executing:  %', query_str;
    EXECUTE query_str INTO result;
    RETURN result;

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_list
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: start character varying, max integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE name &gt; $1 ORDER BY name LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_lookup
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE namespace_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_lookup
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: tenant_id bigint, namespace character varying
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE tenant_id = $1 AND name = $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_lookup_auth_info
Schema: pod
Result Data Type: SETOF namespace_auth_info
Argument Data Types: tenant_id bigint, namespace character varying
Volatility: stable
Language: sql
Source Code:

    SELECT n.namespace_id, n.name, n.username, n.password, n.need_password, t.hostname,
        t.replica_domain, t.public_address, t.replica_public_address
    FROM namespace n, tenant t
    WHERE t.tenant_id = n.tenant_id AND n.tenant_id=$1 AND n.name = $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('namespace_id_seq') | resource_type_namespace();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_next_unique_name
Schema: pod
Result Data Type: text
Argument Data Types: name_prefix text
Volatility: volatile
Language: sql
Source Code:

    SELECT $1 || nextval('namespace_unique_name_seq');

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_orphan
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET is_orphaned = namespace_queue_password($1), xid = xid_next($1)
        WHERE namespace_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_orphan_namespaces_owned_by_device
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: device_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET is_orphaned = TRUE, need_password = namespace_queue_password(namespace_id), 
            need_ro_password = TRUE, xid = xid_next($1)
        WHERE namespace_id IN (
            SELECT namespace_id FROM hdi_local_filesystem WHERE resource_id = $1
        ) RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_owned_by
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: owner namespace_owner
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE namespace_owner = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_owned_by
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: VARIADIC owners namespace_owner[]
Volatility: stable
Language: sql
Source Code:

	SELECT * FROM namespace WHERE namespace_owner = ANY($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_queue_password
Schema: pod
Result Data Type: boolean
Argument Data Types: namespace_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('async_task', 'NAMESPACE_PASSWORD', cast(namespace_id AS text));
    RETURN TRUE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_update
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint, xid bigint, description character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET description = $3, xid = xid_next($1)
        WHERE namespace_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_update_account
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint, xid bigint, username character varying, password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET username = $3, password = $4, need_password = FALSE, xid = xid_next($1)
        FROM (SELECT tenant_id AS tid, username AS uname FROM namespace WHERE namespace_id = $1 AND xid = $2) ns
        WHERE tenant_id = ns.tid AND username = ns.uname RETURNING namespace.*;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_update_account_passwords
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint, xid bigint, password character varying, ro_password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET password = $3, read_only_password = $4, xid = xid_next($1)
        WHERE namespace_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_update_read_only_account
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint, xid bigint, username character varying, password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET read_only_username = $3, read_only_password = $4, need_ro_password = FALSE, xid = xid_next($1)
        WHERE namespace_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespace_update_space
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: namespace_id bigint, total_space bigint, space_used bigint, percent_used integer, object_count bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE namespace SET total_space = $2, space_used = $3, percent_used = $4, object_count = $5,
            xid = xid_next($1)
        WHERE namespace_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: namespaces_by_tenant
Schema: pod
Result Data Type: SETOF namespace
Argument Data Types: tenant_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM namespace WHERE tenant_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: normalize
Schema: pod
Result Data Type: character varying
Argument Data Types: name character varying
Volatility: immutable
Language: c
Source Code:
string_normalize
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_close
Schema: pod
Result Data Type: visible_object
Argument Data Types: object_path character varying, closing_size bigint, closing_hash bytea
Volatility: volatile
Language: sql
Source Code:

    SELECT object_close_int($1, $2, $3, 1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_close_int
Schema: pod
Result Data Type: visible_object
Argument Data Types: object_path character varying, closing_size bigint, closing_hash bytea, add_refcount integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    object_row invisible_object;
    result visible_object;
BEGIN
    SELECT * FROM object_refcount_update(closing_size, closing_hash, add_refcount) INTO result;
    IF result.size IS NULL THEN
        DELETE FROM invisible_object WHERE path = object_path AND state = 'IN_PROGRESS'
            RETURNING * INTO object_row;
        INSERT INTO visible_object(size, hash, storage_id, path, refcount, change_time)
            VALUES (closing_size, closing_hash, object_row.storage_id, 
                    object_row.path, add_refcount, transaction_timestamp())
            RETURNING * INTO result;
    ELSE
        PERFORM file_mark_failed($1);
    END IF;
    RETURN result;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_commit_ordered_update
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $q$ WITH tr AS (SELECT * FROM temp_obj_refcount ORDER BY size, hash)
        SELECT object_refcount_update(size, hash, change) FROM tr; $q$;
        
    EXECUTE $q$ DROP FUNCTION IF EXISTS object_temp_ref_update_$q$ || txid_current() || $q$(BIGINT, BYTEA, INTEGER) $q$;
    DROP TABLE IF EXISTS temp_obj_refcount;
END 

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_decrement_ref
Schema: pod
Result Data Type: visible_object
Argument Data Types: size bigint, hash bytea
Volatility: volatile
Language: sql
Source Code:

    SELECT object_refcount_update($1, $2, -1);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_delete
Schema: pod
Result Data Type: SETOF boolean
Argument Data Types: object_path character varying
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM invisible_object WHERE path = $1 RETURNING TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: object_delete_gc_candidates
Schema: pod
Result Data Type: boolean
Argument Data Types: VARIADIC paths character varying[]
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM invisible_object
        WHERE state = 'PENDING_GC' AND path = ANY($1);
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: object_find_gc_candidates
Schema: pod
Result Data Type: SETOF garbage_collection_result
Argument Data Types: start_path character varying, maxresults integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF start_path IS NULL THEN
        RETURN QUERY EXECUTE $q$ SELECT storage_id, path FROM invisible_object
            WHERE state = 'PENDING_GC' 
            ORDER BY path LIMIT $1; $q$ USING maxResults;
    ELSE
        RETURN QUERY EXECUTE $q$ SELECT storage_id, path FROM invisible_object
            WHERE state = 'PENDING_GC' AND path &gt; $1
            ORDER BY path LIMIT $2; $q$ USING start_path, maxResults;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: object_lookup
Schema: pod
Result Data Type: visible_object
Argument Data Types: size bigint, hash bytea, OUT result visible_object
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM visible_object vo
        WHERE hash(vo.size, vo.hash) = hash($1, $2) AND vo.size = $1 AND vo.hash = $2 AND refcount &gt; 0
        ORDER BY refcount DESC LIMIT 1 INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_lookup_update
Schema: pod
Result Data Type: record
Argument Data Types: size bigint, hash bytea, OUT row_tid tid, OUT object visible_object
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT CTID, vo.* FROM visible_object vo
        WHERE hash(vo.size, vo.hash) = hash($1, $2) AND vo.size = $1 AND vo.hash = $2
        LIMIT 1 FOR UPDATE
        INTO row_tid, object.size, object.hash, object.storage_id, object.path, object.refcount, object.change_time;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_perform_maintenance
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    CLUSTER VERBOSE invisible_object USING idx_invisible_object_path;
    ANALYZE invisible_object;
    SELECT TRUE;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: object_prepare_for_gc
Schema: pod
Result Data Type: boolean
Argument Data Types: failed_age_seconds integer, unused_age_seconds integer, in_progress_age_seconds integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    UPDATE invisible_object SET state = 'PENDING_GC'
        WHERE (state = 'FAILED' AND (change_time + ($1 || ' seconds')::interval) &lt;= transaction_timestamp())
            OR (state = 'UNUSED' AND (change_time + ($2 || ' seconds')::interval) &lt;= transaction_timestamp())
            OR (state = 'IN_PROGRESS' AND (change_time + ($3 || ' seconds')::interval) &lt;= transaction_timestamp());

    -- Find expired unused visible_objects
    WITH demote(size, hash, storage_id, path, change_time) AS
    (
        DELETE FROM visible_object 
            WHERE refcount = 0 AND change_time &lt; transaction_timestamp() - ($2 || ' seconds')::interval
            RETURNING size, hash, storage_id, path, change_time
    )
    INSERT INTO invisible_object(size, hash, storage_id, path, state, change_time)
        SELECT size, hash, storage_id, path, 'PENDING_GC', change_time FROM demote;
    ANALYZE invisible_object;
    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: object_prepare_ordered_update
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CREATE TEMPORARY TABLE temp_obj_refcount(
        size BIGINT,
        hash BYTEA,
        change INTEGER,
       PRIMARY KEY (size, hash)
    ) ON COMMIT DROP;

    EXECUTE $q$
        CREATE OR REPLACE FUNCTION pod.object_temp_ref_update_$q$ || txid_current() 
            || $q$(in_size BIGINT, in_hash BYTEA, in_change INTEGER) RETURNS VOID AS $tru$
        DECLARE 
            tr temp_obj_refcount;
        BEGIN
            UPDATE temp_obj_refcount SET change = change + $3 WHERE size = in_size 
                AND hash = in_hash RETURNING * INTO tr;
            IF tr.size IS NULL THEN
                INSERT INTO temp_obj_refcount(size, hash, change) VALUES (in_size, in_hash, in_change) 
                    RETURNING * INTO tr;
            END IF;
        END $tru$ LANGUAGE PLPGSQL;
    $q$;
    RETURN TRUE;    
EXCEPTION WHEN duplicate_table THEN
    RETURN FALSE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_refcount_update
Schema: pod
Result Data Type: visible_object
Argument Data Types: ctid tid, change integer, OUT result visible_object
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    UPDATE visible_object SET refcount = refcount + $2, change_time = transaction_timestamp()
        WHERE visible_object.CTID = $1 RETURNING *
        INTO result;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_refcount_update
Schema: pod
Result Data Type: visible_object
Argument Data Types: size bigint, hash bytea, change integer, OUT result visible_object
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT (u.oru).* FROM (
        SELECT object_refcount_update(CTID, $3) oru FROM (
            SELECT CTID FROM visible_object vo
                WHERE hash(vo.size, vo.hash) = hash($1, $2) AND vo.size = $1 AND vo.hash = $2 AND
                    refcount + $3 &gt;= 0 ORDER BY refcount * $3 DESC LIMIT 1
            ) AS c
        ) AS u
        INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_temp_ref_update
Schema: pod
Result Data Type: void
Argument Data Types: in_size bigint, in_hash bytea, in_change integer
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    EXECUTE $q$ SELECT object_temp_ref_update_$q$ || txid_current() || $q$($1, $2, $3) $q$ 
        USING in_size, in_hash, in_change;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: object_total_storage_used
Schema: pod
Result Data Type: numeric
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT coalesce(sum(size), 0) FROM visible_object;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: over_soft_quota
Schema: pod
Result Data Type: boolean
Argument Data Types: quota bigint, soft_perc bigint, space_used numeric
Volatility: immutable
Language: sql
Source Code:

    SELECT ($1 * ($2 / 100.0)) &lt;= $3;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: owner_file_count
Schema: pod
Result Data Type: numeric
Argument Data Types: fs_id bigint, OUT count numeric
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT sum(file_count) + sum(dir_count) FROM filesystem
        WHERE owner_id = (SELECT owner_id FROM filesystem f WHERE f.fs_id = $1)
            AND state = 'ACTIVE'
            AND type NOT IN ('TEAM'::filesystem_type, 'EDP'::filesystem_type)
        INTO count;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: path_concat
Schema: pod
Result Data Type: character varying
Argument Data Types: parent_path character varying, child_path character varying
Volatility: immutable
Language: c
Source Code:
path_concat
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: path_split
Schema: pod
Result Data Type: record
Argument Data Types: path character varying, OUT parent character varying, OUT name character varying
Volatility: immutable
Language: c
Source Code:
path_split
Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: path_to_array
Schema: pod
Result Data Type: character varying[]
Argument Data Types: path character varying, OUT entries character varying[]
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    IF left(path, 1) &lt;&gt; '/' THEN
        RAISE EXCEPTION 'Path does not start with /: %', path;
    END IF;
    entries := string_to_array(trim(BOTH '/' FROM path), '/');
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: perform_extended_upgrade
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF upgrade_filesystem_schemas() THEN
        RETURN NULL;
    ELSE
        PERFORM clear_all_fs_upgrade_attempt_counts();
        RETURN 'DONE';
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: perform_extended_upgrade_phase2
Schema: pod
Result Data Type: character varying
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF upgrade_filesystem_schemas() THEN
        RETURN NULL;
    ELSE
        PERFORM clear_all_fs_upgrade_attempt_counts();
        RETURN 'DONE';
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_config_delete
Schema: pod
Result Data Type: SETOF pod_config
Argument Data Types: del_key character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result pod_config;
BEGIN
    DELETE FROM pod_config WHERE key = $1 RETURNING * INTO result;
    IF result.key IS NOT NULL THEN
        PERFORM pgq.insert_event('pod_config', 'DELETE', del_key, result.value, NULL, NULL, NULL);
    END IF;
    RETURN next result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_config_lookup
Schema: pod
Result Data Type: SETOF pod_config
Argument Data Types: key_name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    key_len INT;
    val VARCHAR;
    result pod_config;
BEGIN
    key_len = length(key_name);
    IF key_len &gt; 7 AND left(key_name, 7) = 'limits.' THEN
        SELECT * FROM get_limit(right(key_name, key_len - 7)) INTO val;
        result := (key_name, val)::pod_config;
        RETURN NEXT result;
    ELSE
        RETURN QUERY SELECT * FROM pod_config WHERE key = key_name;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_config_update
Schema: pod
Result Data Type: pod_config
Argument Data Types: upd_key character varying, upd_value character varying, update_if_exists boolean, system_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM pod_config_update($1, $2, $3, TRUE, $4);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_config_update
Schema: pod
Result Data Type: pod_config
Argument Data Types: upd_key character varying, upd_value character varying, update_if_exists boolean, use_pgq boolean, system_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    key_len INT;
    config_row RECORD;
    result pod_config;
    old_value pod_config;
    new_value VARCHAR;
BEGIN
    -- handle limits first
    key_len = length(upd_key);
    IF key_len &gt; 7 AND left(upd_key, 7) = 'limits.' THEN
        IF use_pgq THEN
            old_value := pod_config_lookup(upd_key);
        END IF;
        IF old_value.key IS NULL OR update_if_exists THEN
            new_value := limit_update_int(right(upd_key, key_len - 7), upd_value::NUMERIC)::VARCHAR;
            IF use_pgq THEN
                PERFORM pgq.insert_event('pod_config', 'UPDATE', upd_key, old_value.value,
                                         new_value, NULL, NULL);
            END IF;
            result := (upd_key, new_value)::pod_config;
        ELSE
            result := old_value;
        END IF;
        RETURN result;
    END IF;

    -- Try to update first if that fails insert
    -- If the insert fails loop through again and update
    LOOP
        SELECT CTID, pod_config FROM pod_config WHERE key = upd_key INTO config_row FOR UPDATE;
        IF config_row.ctid IS NOT NULL THEN
            old_value := config_row.pod_config;
            IF update_if_exists THEN
                UPDATE pod_config SET value = upd_value WHERE CTID = config_row.ctid
                    RETURNING * INTO result;
                IF use_pgq THEN
                    PERFORM pgq.insert_event('pod_config', 'UPDATE', upd_key, old_value.value,
                                             result.value, NULL, NULL);
                    PERFORM system_id_update(system_id);
                END IF;
            ELSE
                result := old_value;
            END IF;
            RETURN result;
        END IF;
        BEGIN
            INSERT INTO pod_config(key, value) VALUES (upd_key, upd_value) RETURNING * INTO result;
            IF use_pgq THEN
                PERFORM pgq.insert_event('pod_config', 'UPDATE', upd_key, NULL, result.value, NULL, NULL);
                PERFORM system_id_update(system_id);
            END IF;
            RETURN result;
        EXCEPTION WHEN unique_violation THEN -- Loop again
        END;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_number
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '0'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: pod_schema_version
Schema: pod
Result Data Type: integer
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

            SELECT '120'::integer;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: possible_parent_mountpoints
Schema: pod
Result Data Type: SETOF resolved_path
Argument Data Types: fullpath character varying
Volatility: volatile
Language: sql
Source Code:

    WITH RECURSIVE mountpoint(mountpoint_path, parent, name) AS (
            SELECT p.parent, '/', p.name FROM path_split($1) p WHERE length(p.parent) &gt; 1
        UNION ALL
            SELECT (s.ps).parent,
                   '/' || (s.ps).name || CASE WHEN parent = '/' THEN '' ELSE parent END,
                   name
              FROM (SELECT mountpoint_path, parent, name, path_split(mountpoint_path) ps FROM mountpoint) s
              WHERE length((s.ps).parent) &gt; 1
    ) SELECT NULL::BIGINT, mountpoint_path, parent, name, NULL::BOOLEAN, NULL::TIMESTAMPTZ, NULL::BOOLEAN,
             NULL::filesystem_type, NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, NULL::shared_folder_membership_role, 
             NULL::dir_entry_permission[]
        FROM mountpoint;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_create
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: name character varying, description character varying, fss_config character varying, mui_config character varying, auth_config character varying, edp_config character varying, system_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result profile;
BEGIN
    PERFORM system_id_update(system_id);
    INSERT INTO profile(profile_id, name, description, fss_config, mui_config, auth_config, edp_config, xid, state)
        VALUES (profile_next_id(), $1, $2, $3, $4, $5, $6, 1, 'ACTIVE'::profile_state)
        RETURNING * INTO result;
    PERFORM pgq.insert_event('resource_xid', result.profile_id::TEXT, result.xid::TEXT);
    PERFORM profile_name_check(name);
    PERFORM profile_limit_check();
    RETURN NEXT result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_db_users_after
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: profile_id bigint, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.* FROM user_account ua, user_to_profile up
        WHERE up.profile_id = $1 AND ua.user_id = up.user_id
            AND ua.user_id &gt; $2 AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
            ORDER BY ua.user_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_delete
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: profile_id bigint, system_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result profile;
BEGIN
    PERFORM system_id_update($2);
    UPDATE profile AS p
        SET (state, xid) = ('DELETED'::profile_state, p.xid + 1)
        WHERE p.profile_id = $1 AND state = 'ACTIVE'::profile_state
        RETURNING * INTO result;
    IF result.profile_id IS NOT NULL THEN
        PERFORM pgq.insert_event('resource_xid', $1::TEXT, result.xid::TEXT);
        RETURN NEXT result;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_limit_check
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM limit_profiles(count(*)) FROM profile_list();
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_list
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM profile WHERE state != 'DELETED'::profile_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_lookup
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: name character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM profile WHERE name = $1 AND state != 'DELETED'::profile_state;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_lookup
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: profile_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY SELECT * FROM profile AS p where p.profile_id = $1 AND state != 'DELETED'::profile_state;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_name_check
Schema: pod
Result Data Type: void
Argument Data Types: name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result BIGINT;
BEGIN
    SELECT COUNT(*) FROM profile_lookup(name) INTO result;
    IF result &gt; 1 THEN
        RAISE EXCEPTION 'PROFILE DUPLICATE NAME';
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('profile_id_seq') | resource_type_profile();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_update
Schema: pod
Result Data Type: SETOF profile
Argument Data Types: profile_id bigint, name character varying, description character varying, fss_config character varying, mui_config character varying, auth_config character varying, edp_config character varying, xid bigint, system_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('resource_xid', $1::TEXT, ($8 + 1)::TEXT);
    PERFORM system_id_update(system_id);
    RETURN QUERY UPDATE profile AS p
        SET (name, description, fss_config, mui_config, auth_config, edp_config, xid) = ($2, $3, $4, $5, $6, $7, $8 + 1)
        WHERE p.profile_id = $1 AND p.xid = $8 AND p.state = 'ACTIVE'::profile_state
        RETURNING *;
    PERFORM profile_name_check(name);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_users_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: profile_id bigint, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, user_to_profile up, auth_provider ap
        WHERE up.profile_id = $1 AND ua.user_id = up.user_id AND ua.auth_provider_id = ap.auth_provider_id
            AND ua.user_id &gt; $2 AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
            ORDER BY ua.user_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_users_external_inaccessible_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: profile_id bigint, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, user_to_profile up, auth_provider ap
        WHERE up.profile_id = $1 AND ua.user_id = up.user_id AND ua.auth_provider_id = ap.auth_provider_id
            AND ua.user_id &gt; $2 AND ua.external_state &lt;&gt; 'ACTIVE' ORDER BY ua.user_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_users_inactive_after
Schema: pod
Result Data Type: SETOF inactive_user
Argument Data Types: profile_id bigint, user_id bigint, seconds integer, max_results integer
Volatility: volatile
Language: sql
Source Code:

    WITH max_user_access(user_id, latest_access) AS (
        SELECT c.user_id, MAX(last_access) latest_access
          FROM client c, user_account u, user_to_profile up
          WHERE up.profile_id = $1 AND up.user_id = u.user_id
              AND u.user_id &gt; $2
              AND u.state &lt;&gt; 'INITIALIZED'::user_state AND u.state &lt;&gt; 'DELETED'::user_state
              AND u.user_id = c.user_id
          GROUP BY c.user_id
          ORDER BY c.user_id
    ) SELECT u.user_id, u.name, u.email, u.state, u.display_name, a.type, m.latest_access
          FROM user_account u, max_user_access m, auth_provider a
          WHERE u.user_id = m.user_id AND u.auth_provider_id = a.auth_provider_id
              AND ($3 IS NULL OR m.latest_access &lt; now() - ($3 || 'seconds')::INTERVAL)
          ORDER BY u.user_id
          LIMIT $4;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_users_storage_after
Schema: pod
Result Data Type: SETOF user_storage
Argument Data Types: quota_percent integer, include_versions boolean, profile_id bigint, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM (SELECT u.user_id, u.name, u.email, u.state, u.display_name, u.effective_quota,
            a.type, filesystem_space_used_by(u.user_id, FALSE)::BIGINT,
            CASE WHEN $2
                THEN filesystem_space_used_by(u.user_id, TRUE)::BIGINT
                ELSE NULL
            END
    FROM user_account u, user_to_profile up, auth_provider a
    WHERE up.profile_id = $3 AND up.user_id = u.user_id AND u.auth_provider_id = a.auth_provider_id
            AND u.user_id &gt; $4 AND u.state &lt;&gt; 'INITIALIZED'::user_state AND u.state &lt;&gt; 'DELETED'::user_state) us
    WHERE $2 OR us.effective_quota = 0 OR ($1 / 100.0 &lt;= us.filesystem_space_used_by / us.effective_quota::double precision)
    ORDER BY us.user_id LIMIT $5;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: profile_users_with_profile_overrides_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: profile_id bigint, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, user_to_profile up, auth_provider ap
        WHERE up.profile_id = $1 AND ua.user_id = up.user_id AND ua.auth_provider_id = ap.auth_provider_id
            AND ua.user_id &gt; $2 AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
            AND ua.profile_overrides IS NOT NULL
            ORDER BY ua.user_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_event_retry
Schema: pod
Result Data Type: integer
Argument Data Types: batch_id bigint, event_id bigint, retry_seconds integer
Volatility: volatile
Language: sql
Source Code:

   SELECT pgq.event_retry($1, $2, $3);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_finish_batch
Schema: pod
Result Data Type: integer
Argument Data Types: batch_id bigint
Volatility: volatile
Language: sql
Source Code:

   SELECT pgq.finish_batch($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_get_batch_events
Schema: pod
Result Data Type: SETOF record
Argument Data Types: batch_id bigint, OUT ev_id bigint, OUT ev_time timestamp with time zone, OUT ev_txid bigint, OUT ev_retry integer, OUT ev_type text, OUT ev_data text, OUT ev_extra1 text, OUT ev_extra2 text, OUT ev_extra3 text, OUT ev_extra4 text
Volatility: volatile
Language: sql
Source Code:

   SELECT pgq.get_batch_events($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_next_batch
Schema: pod
Result Data Type: bigint
Argument Data Types: queue_name text, consumer_name text, OUT batch_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
   batch_id := pgq.next_batch($1, $2);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_register_consumer
Schema: pod
Result Data Type: integer
Argument Data Types: queue_name text, consumer_name text
Volatility: volatile
Language: sql
Source Code:

   SELECT pgq.register_consumer($1, $2);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: queue_unregister_consumer
Schema: pod
Result Data Type: integer
Argument Data Types: queue_name text, consumer_name text
Volatility: volatile
Language: sql
Source Code:

   SELECT pgq.unregister_consumer($1, $2);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: raise_mobilized_path
Schema: pod
Result Data Type: void
Argument Data Types: path resolved_path
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SET LOCAL log_min_messages TO PANIC;
    RAISE EXCEPTION 'MOBILIZED PATH DETECTED: {&quot;fsId&quot; : %, &quot;mountpointPath&quot;: %, &quot;parent&quot;: %, 
        &quot;name&quot;: %}', path.fs_id, quote_ident(path.mountpoint_path), 
            quote_ident(coalesce(path.parent, '')), quote_ident(coalesce(path.name));
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: raise_mobilized_rename
Schema: pod
Result Data Type: void
Argument Data Types: src_path resolved_path, dest_path resolved_path
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RAISE EXCEPTION 'MOBILIZED RENAME DETECTED: {&quot;srcFsId&quot; : %, &quot;srcMountPath&quot;: %, &quot;srcParent&quot;: %, 
        &quot;srcName&quot;: %, &quot;destFsId&quot; : %, &quot;destMountPath&quot;: %, &quot;destParent&quot;: %, &quot;destName&quot;: %}', 
            src_path.fs_id, quote_ident(src_path.mountpoint_path), 
            quote_ident(coalesce(src_path.parent, '')), quote_ident(coalesce(src_path.name, '')), 
            dest_path.fs_id, quote_ident(dest_path.mountpoint_path), 
            quote_ident(coalesce(dest_path.parent, '')), quote_ident(coalesce(dest_path.name, ''));
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: reporting_system_storage
Schema: pod
Result Data Type: system_storage
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT object_total_storage_used(), filesystem_total_storage_used();

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: request_create
Schema: pod
Result Data Type: SETOF request
Argument Data Types: type request_type, affected_resource_id bigint, data character varying, requester_id bigint
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO request(type, affected_resource_id, data, create_time, tsextra, requester_id) VALUES
        ($1, $2, $3, statement_timestamp(), request_tsextra_next(), $4) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: request_delete
Schema: pod
Result Data Type: SETOF request
Argument Data Types: affected_resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM request WHERE affected_resource_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: request_list
Schema: pod
Result Data Type: SETOF request
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM request ORDER BY create_time, tsextra;  

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: request_lookup
Schema: pod
Result Data Type: SETOF request
Argument Data Types: affected_resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM request WHERE affected_resource_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: request_tsextra_next
Schema: pod
Result Data Type: smallint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT cast(NEXTVAL('request_tsextra_seq') % 32767 AS SMALLINT);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: reset_failed_fs_upgrade_attempts
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    UPDATE filesystem SET upgrade_attempts = 0 WHERE upgrade_attempts &gt;= get_max_fs_upgrade_attempts_config();

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_mounted_path
Schema: pod
Result Data Type: character varying
Argument Data Types: user_id bigint, sf_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_type filesystem_type;
    mounted_path VARCHAR;
BEGIN
    PERFORM set_path_read_user_private_fs(user_id);
    EXECUTE $q$ SELECT * FROM entry_lookup_first_mountpoint($1) $q$
        USING sf_id
        INTO mounted_path;
    RETURN mounted_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, userid bigint, fullpath character varying, resolve_mountpoints_to_mounted_fs boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result resolved_path;
BEGIN
    SELECT * FROM resolve_path(fs_id, userid, fullpath, resolve_mountpoints_to_mounted_fs, TRUE) 
        INTO result;
    return result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, userid bigint, fullpath character varying, resolve_mountpoints_to_mounted_fs boolean, throw_if_mobilized boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    arecord RECORD;
    mounted_fs mounted_filesystem_result;
    normalized_path VARCHAR;
    normalized_mountpoint VARCHAR;
    resolved_path VARCHAR;
    mountpoint_parts VARCHAR[];
    path_parts VARCHAR[];
    result resolved_path;
    is_owner BOOLEAN;
    cur_role shared_folder_membership_role;
    permissions dir_entry_permission[] := dir_entry_full_perms();
BEGIN
    IF fullpath = '/' THEN
        result := (fs_id, '/', NULL::VARCHAR, '', true, NULL::TIMESTAMPTZ, TRUE, 'PRIVATE'::filesystem_type,
                   NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, cur_role, permissions)::resolved_path;
        RETURN result;
    END IF;

    normalized_path := normalize(fullpath || '/');
    SELECT * FROM sf_lookup_shared_folder_containing_path(userid, normalized_path) INTO arecord;
    mounted_fs := arecord.result;
    normalized_mountpoint := arecord.normalized_mp;

    IF mounted_fs IS NULL THEN
        path_parts := path_to_array(fullpath);
        result := array_to_resolved_path(fs_id, path_parts, NULL::VARCHAR, 0, true,
            NULL::TIMESTAMPTZ, TRUE, 'PRIVATE'::filesystem_type, NULL, NULL, cur_role, permissions);
    ELSE
        IF length(normalized_path) = length(normalized_mountpoint) THEN
            IF resolve_mountpoints_to_mounted_fs THEN
                cur_role := sf_lookup_role(userid, mounted_fs.fs_id);
                permissions := sf_resolve_permissions(cur_role);
                is_owner := mounted_fs.owner_id = userid;
                result := (mounted_fs.fs_id, mounted_fs.mounted_path, NULL::VARCHAR, '', is_owner,
                    mounted_fs.shared_time, mounted_fs.sync, mounted_fs.type, NULL, NULL, 
                    cur_role, permissions)::resolved_path;
                    
                IF throw_if_mobilized AND fs_is_mobilized(mounted_fs.type) THEN
                    PERFORM raise_mobilized_path(result);
                END IF;
            ELSE
                path_parts := path_to_array(fullpath);
                result := array_to_resolved_path(fs_id, path_parts, NULL::VARCHAR, 0, true,
                    NULL::TIMESTAMPTZ, TRUE, 'PRIVATE'::filesystem_type, NULL, NULL, cur_role, permissions);
            END IF;
        ELSE
            cur_role := sf_lookup_role(userid, mounted_fs.fs_id);
            permissions := sf_resolve_permissions(cur_role);
            is_owner := mounted_fs.owner_id = userid;
            mountpoint_parts := path_to_array(normalized_mountpoint);
            path_parts := path_to_array(fullpath);
            result := array_to_resolved_path(mounted_fs.fs_id, path_parts, mounted_fs.mounted_path,
                                             array_length(mountpoint_parts, 1), is_owner,
                                             mounted_fs.shared_time, mounted_fs.sync, mounted_fs.type, NULL, NULL, 
                                             cur_role, permissions);
            IF throw_if_mobilized AND fs_is_mobilized(mounted_fs.type) THEN
                PERFORM raise_mobilized_path(result);
            END IF;
        END IF;
    END IF;
    RETURN result;

END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, userid bigint, fullpath character varying, resolve_mountpoints_to_mounted_fs boolean, throw_if_mobilized boolean, resolve_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result resolved_path;
    path_parts VARCHAR[];
    path_parts_len INTEGER;
    parent_path VARCHAR := '/';
    cur_path VARCHAR;
    cur_entry dir_entry_result;
    corresponding_mount dir_entry_result;
    unmounted_fs filesystem;
    i INTEGER;
    last_path_part BOOLEAN := FALSE;
    cur_role shared_folder_membership_role;
    permissions dir_entry_permission[] := dir_entry_full_perms();
BEGIN
    IF NOT resolve_deleted OR length(fullpath) &lt; 2 THEN
        -- old way of resolving paths
        result := resolve_path(fs_id, userid, fullpath, resolve_mountpoints_to_mounted_fs, throw_if_mobilized);
    ELSE
        -- walk parents, looking for a latest version that is a mountpoint
        path_parts := path_to_array(fullpath);
        path_parts_len := array_length(path_parts, 1);
        FOR i IN 1..path_parts_len LOOP
            cur_path := full_path(parent_path, path_parts[i]);
            IF i = path_parts_len THEN
                last_path_part := TRUE;
            END IF;

            -- lookup the entry. throws path not found if not found
            IF last_path_part THEN
                -- last entry could be a file or a directory
                EXECUTE $q$ SELECT * FROM entry_lookup_ext($1, $2, TRUE) $q$
                    INTO cur_entry USING parent_path, path_parts[path_parts_len];
            ELSE
                -- it must be directory
                EXECUTE $q$ SELECT * FROM directory_lookup_ext($1, TRUE, TRUE) $q$
                    INTO cur_entry USING cur_path;
            END IF;
            
            IF cur_entry.fs_id IS NOT NULL THEN
                unmounted_fs := filesystem_lookup_one(cur_entry.fs_id);
                
                IF (NOT last_path_part) OR resolve_mountpoints_to_mounted_fs THEN
                    IF throw_if_mobilized AND fs_is_mobilized(unmounted_fs.type) THEN
                        -- this result is only used in the mobilized exception thrown
                        result := (unmounted_fs.fs_id,
                                   cur_path,
                                   array_to_path(path_parts[i+1:path_parts_len-1]),
                                   path_parts[path_parts_len],
                                   unmounted_fs.owner_id IS NOT NULL AND unmounted_fs.owner_id = userid,
                                   unmounted_fs.shared_time, cur_entry.sync, unmounted_fs.type,
                                   cur_entry.timestamp, cur_entry.replaced, cur_role, permissions);
                        PERFORM raise_mobilized_path(result);
                    END IF;
                    IF NOT cur_entry.is_create AND NOT sf_is_accessible_at_past_time(cur_entry.fs_id, userid) THEN
                        result := unresolvable_path(cur_path, throw_if_mobilized);
                    ELSE
                        -- cur_path is or was a mountpoint to a shared or team folder, and either we owned it, or we are currently a member of the
                        -- same shared/team folder. Resolve to that filesystem, and we're done (there can't be sub-mountpoints).
                        IF NOT cur_entry.is_create THEN
                            -- It is a delete of a mountpoint; use the corresponding create of the mountpoint
                            EXECUTE $q$ SELECT * FROM entry_lookup_corresponding_mount($1, $2, $3, $4) $q$
                                USING cur_entry.parent, cur_entry.name, cur_entry.version_id, FALSE
                                INTO corresponding_mount;
                            IF corresponding_mount.version_id IS NULL THEN
                                result := unresolvable_path(cur_path, throw_if_mobilized);
                                RETURN result;
                            END IF;
                            cur_entry := corresponding_mount;
                        END IF;
                        IF NOT last_path_part THEN
                            cur_role := CASE WHEN cur_entry.is_create THEN sf_lookup_role(userid, unmounted_fs.fs_id) ELSE NULL END;
                            permissions := sf_resolve_permissions(cur_role);
                            result := (unmounted_fs.fs_id,
                                       cur_path,
                                       array_to_path(path_parts[i+1:path_parts_len-1]),
                                       path_parts[path_parts_len],
                                       unmounted_fs.owner_id IS NOT NULL AND unmounted_fs.owner_id = userid,
                                       unmounted_fs.shared_time, cur_entry.sync, unmounted_fs.type,
                                       cur_entry.timestamp, cur_entry.replaced, cur_role, permissions);
                        ELSIF resolve_mountpoints_to_mounted_fs THEN
                            cur_role := CASE WHEN cur_entry.is_create THEN sf_lookup_role(userid, unmounted_fs.fs_id) ELSE NULL END;
                            permissions := sf_resolve_permissions(cur_role);
                            result := (unmounted_fs.fs_id, cur_path, NULL::VARCHAR, '',
                                       unmounted_fs.owner_id IS NOT NULL AND unmounted_fs.owner_id = userid,
                                       unmounted_fs.shared_time, cur_entry.sync, unmounted_fs.type,
                                       cur_entry.timestamp, cur_entry.replaced, cur_role, permissions)::resolved_path;
                        ELSE
                            result := (fs_id, '/', array_to_path(path_parts[1:path_parts_len-1]), path_parts[path_parts_len],
                                       TRUE, NULL::TIMESTAMPTZ, TRUE, 'PRIVATE'::filesystem_type,
                                       NULL::TIMESTAMPTZ, NULL::TIMESTAMPTZ, NULL, dir_entry_full_perms())::resolved_path;
                        END IF;
                    END IF;
                    RETURN result;
                END IF;
            END IF;

            parent_path := cur_path;
        END LOOP;

        -- No mountpoints were encountered.  Resolve to private FS
        result := (fs_id, '/', array_to_path(path_parts[1:path_parts_len-1]), path_parts[path_parts_len], TRUE, NULL::TIMESTAMPTZ,
               TRUE, 'PRIVATE'::filesystem_type, NULL, NULL, cur_role, permissions)::resolved_path;
    END IF;

    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_at_time
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, userid bigint, fullpath character varying, resolve_mountpoints_to_mounted_fs boolean, throw_if_unresolvable boolean, point_in_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    path_parts VARCHAR[];
    path_parts_len INTEGER;
    parent_path VARCHAR := '/';
    cur_path VARCHAR;
    old_entry dir_entry_result;
    old_mounted_fs filesystem;
    i INTEGER;
    result resolved_path;
    last_path_part BOOLEAN := FALSE;
    cur_role shared_folder_membership_role;
    permissions dir_entry_permission[] := dir_entry_full_perms();
BEGIN
    IF fullpath = '/' THEN
        result := (fs_id, '/', NULL::VARCHAR, '', true, NULL::TIMESTAMPTZ, TRUE, 'PRIVATE'::filesystem_type, 
                    NULL, NULL, cur_role, permissions)::resolved_path;
        RETURN result;
    END IF;

    -- walk path at time, looking for mountpoints
    path_parts := path_to_array(fullpath);
    path_parts_len := array_length(path_parts, 1);
    PERFORM set_path_read_user_private_fs(userid);
    FOR i IN 1..path_parts_len LOOP
        cur_path := full_path(parent_path, path_parts[i]);
        IF i = path_parts_len THEN
            last_path_part := TRUE;
        END IF;

        -- lookup the entry. throws path not found if not found
        IF last_path_part THEN
            -- last entry could be a file or a directory
            EXECUTE $q$ SELECT * FROM entry_lookup_at_time_ext($1, $2, $3) $q$
                INTO old_entry USING parent_path, path_parts[path_parts_len], point_in_time;
        ELSE
            -- it must be directory
            EXECUTE $q$ SELECT * FROM directory_lookup_at_time_ext($1, $2, FALSE, FALSE, FALSE) $q$
                INTO old_entry USING cur_path, point_in_time;
        END IF;

        IF old_entry.fs_id IS NOT NULL THEN
            old_mounted_fs := filesystem_lookup_one(old_entry.fs_id);
            
            IF ((NOT last_path_part) OR resolve_mountpoints_to_mounted_fs) THEN
                
                IF NOT sf_is_accessible_at_past_time(old_entry.fs_id, userid) THEN
                    result := unresolvable_path(cur_path, throw_if_unresolvable);
                ELSE
                    -- cur_path was a mountpoint to a shared or team folder, and either we owned it, or we are currently a member of the
                    -- same shared/team folder. Resolve to that filesystem, and we're done (there can't be sub-mountpoints).
                    IF NOT last_path_part THEN
                        cur_role := sf_lookup_role(userid, old_mounted_fs.fs_id);
                        permissions := sf_resolve_permissions(cur_role);
                        result := (old_mounted_fs.fs_id,
                                   cur_path,
                                   array_to_path(path_parts[i+1:path_parts_len-1]),
                                   path_parts[path_parts_len], old_mounted_fs.owner_id IS NOT NULL AND old_mounted_fs.owner_id = userid,
                                   old_mounted_fs.shared_time, old_entry.sync, old_mounted_fs.type, NULL, NULL, 
                                   cur_role, permissions)::resolved_path;
                    ELSIF resolve_mountpoints_to_mounted_fs THEN
                        cur_role := sf_lookup_role(userid, old_mounted_fs.fs_id);
                        permissions := sf_resolve_permissions(cur_role);
                        result := (old_mounted_fs.fs_id, cur_path, NULL::VARCHAR, '', old_mounted_fs.owner_id IS NOT NULL AND old_mounted_fs.owner_id = userid,
                                   old_mounted_fs.shared_time, old_entry.sync, old_mounted_fs.type, NULL, NULL, 
                                   cur_role, permissions)::resolved_path;
                    ELSE
                        result := (fs_id, '/', array_to_path(path_parts[1:path_parts_len-1]), path_parts[path_parts_len], TRUE, NULL::TIMESTAMPTZ,
                                   TRUE, 'PRIVATE'::filesystem_type, NULL, NULL, cur_role, permissions)::resolved_path;
                    END IF;
                END IF;
                RETURN result;
            END IF;
        END IF;

        parent_path := cur_path;
    END LOOP;

    -- No mountpoints were encountered.  Resolve to private FS
    result := (fs_id, '/', array_to_path(path_parts[1:path_parts_len-1]), path_parts[path_parts_len], TRUE, NULL::TIMESTAMPTZ,
               TRUE, 'PRIVATE'::filesystem_type, NULL, NULL, cur_role, permissions)::resolved_path;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_at_time_lock_int
Schema: pod
Result Data Type: record
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_unresolvable boolean, point_in_time timestamp with time zone, OUT result resolved_path, OUT locked_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    locked_fs := set_path_wlock_fs(fs_id);
    SELECT * FROM resolve_path_at_time(fs_id, locked_fs.owner_id, fullpath, resolve_mountpoint,
        throw_if_unresolvable, point_in_time) INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_at_time_read_fs
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_unresolvable boolean, point_in_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    private_fs filesystem;
BEGIN
    IF point_in_time IS NULL THEN
        resolved_path := resolve_path_read_fs(fs_id, fullpath, resolve_mountpoint, throw_if_unresolvable);
        RETURN resolved_path;
    END IF;

    private_fs := set_path_read_fs(fs_id);

    SELECT * FROM resolve_path_at_time(fs_id, private_fs.owner_id, fullpath, resolve_mountpoint,
        throw_if_unresolvable, point_in_time) INTO resolved_path;
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_read_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_at_time_wlock
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_unresolvable boolean, point_in_time timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result RECORD;
    resolved_path resolved_path;
BEGIN
    SELECT * FROM resolve_path_at_time_lock_int(fs_id, fullpath, resolve_mountpoint, throw_if_unresolvable, point_in_time) INTO result;
    resolved_path := result.result;
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_wlock_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_lock_int
Schema: pod
Result Data Type: record
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, OUT result resolved_path, OUT locked_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    arecord record;
BEGIN
    SELECT * FROM resolve_path_lock_int(fs_id, fullpath, resolve_mountpoint, TRUE) INTO arecord;
    result := arecord.result;
    locked_fs := arecord.locked_fs;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_lock_int
Schema: pod
Result Data Type: record
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_mobilized boolean, OUT result resolved_path, OUT locked_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    locked_fs := set_path_wlock_fs(fs_id);
    SELECT * FROM resolve_path(fs_id, locked_fs.owner_id, fullpath, resolve_mountpoint, 
        throw_if_mobilized) INTO result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_read_fs
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_mobilized boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    private_fs filesystem;
BEGIN
    private_fs := set_path_read_fs(fs_id);
    SELECT * FROM resolve_path(fs_id, private_fs.owner_id, fullpath, resolve_mountpoint, 
        throw_if_mobilized) INTO resolved_path;
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_read_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_read_fs
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_mobilized boolean, resolve_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    resolved_path resolved_path;
    private_fs filesystem;
BEGIN
    private_fs := set_path_read_fs(fs_id);
    resolved_path := resolve_path(fs_id, private_fs.owner_id, fullpath, resolve_mountpoint,
                                  throw_if_mobilized, resolve_deleted);
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_read_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_wlock
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result RECORD;
    resolved_path resolved_path;
BEGIN
    SELECT * FROM resolve_path_lock_int(fs_id, fullpath, resolve_mountpoint) INTO result;
    resolved_path := result.result;
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_wlock_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_path_wlock
Schema: pod
Result Data Type: resolved_path
Argument Data Types: fs_id bigint, fullpath character varying, resolve_mountpoint boolean, throw_if_mobilized boolean, resolve_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    resolved_path resolved_path;
BEGIN
    private_fs := set_path_wlock_fs(fs_id);
    resolved_path := resolve_path(fs_id, private_fs.owner_id, fullpath, resolve_mountpoint,
                                  throw_if_mobilized, resolve_deleted);
    IF resolved_path.fs_id &lt;&gt; fs_id THEN
        PERFORM set_path_wlock_fs(resolved_path.fs_id);
    END IF;
    RETURN resolved_path;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: clientid bigint, fs_id bigint, fs_role shared_folder_membership_role, fs_permissions dir_entry_permission[], fs_type filesystem_type, d dir_entry_result
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    curr_fs_id BIGINT := fs_id;
    curr_fs_type filesystem_type := fs_type;
    curr_role shared_folder_membership_role := fs_role;
BEGIN
    IF d.fs_id IS NOT NULL THEN
       curr_fs_id := d.fs_id;
       curr_role := sf_lookup_role(user_extract_id(fs_id), d.fs_id);
       SELECT type FROM filesystem WHERE filesystem.fs_id = curr_fs_id INTO curr_fs_type;
    END IF;
    
    CASE curr_fs_type
       WHEN 'EDP' THEN
           RETURN edp_resolve_permissions(clientid, curr_fs_id);
       ELSE
           IF d IS NULL THEN
               RETURN fs_permissions;
           END IF;
           
           RETURN sf_resolve_permissions(curr_role, d.permissions);
    END CASE;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: clientid bigint, m mounted_filesystem_result, d dir_entry_result
Volatility: stable
Language: sql
Source Code:

    SELECT resolve_permissions($1, $2.fs_id, $2.curr_role, sf_resolve_permissions($2.curr_role), $2.type, $3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: clientid bigint, r resolved_path, d dir_entry_result
Volatility: stable
Language: sql
Source Code:

    SELECT resolve_permissions($1, $2.fs_id, $2.curr_role, $2.permissions, $2.type, $3);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resolve_share_path_read_fs
Schema: pod
Result Data Type: resolved_path
Argument Data Types: sf filesystem, clientid bigint, parent character varying, name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    userid BIGINT;
    mountpoint_entry dir_entry_result;
    cur_role shared_folder_membership_role;
    permissions dir_entry_permission[];
    is_owner BOOLEAN;
    result resolved_path;
BEGIN
    userid := user_id FROM client_lookup(clientid);
    PERFORM set_path_read_user_private_fs(userid);
    EXECUTE $q$ SELECT * FROM entry_lookup_by_fs_result($1) $q$ USING sf.fs_id INTO mountpoint_entry;
    cur_role := sf_lookup_role(userid, sf.fs_id);
    permissions := sf_resolve_permissions(cur_role);
    is_owner := (sf.owner_id = userid);

    result := (sf.fs_id, full_path(mountpoint_entry.parent, mountpoint_entry.name), parent, name,
               is_owner, sf.shared_time, mountpoint_entry.sync, sf.type, mountpoint_entry.timestamp,
               NULL::TIMESTAMPTZ, cur_role, permissions)::resolved_path;

    PERFORM set_path_read_fs(sf.fs_id);
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_mask_sub_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '8388607'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_mask_type
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '9079256848778919936'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_mask_user
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '144115188067467264'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_max_content
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '36028797018963967'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_max_non_sub_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '144115188075855871'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_max_sub_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '8388607'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_max_type
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '63'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_max_user
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '17179869183'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_shift_user
Schema: pod
Result Data Type: integer
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '23'::integer;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_auth_provider
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2305843009213693952'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_client
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '288230376151711744'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_download
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2594073385365405696'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_filesystem
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '144115188075855872'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_filesystem_not_user_based
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1729382256910270464'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_hdi_device
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '864691128455135232'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_hdi_model_number
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2449958197289549824'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_hdi_template
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1152921504606846976'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_link
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1297036692682702848'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_mobilized_server
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1873497444986126336'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_mobilized_share
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2017612633061982208'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_namespace
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1441151880758558720'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_pod
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '720575940379279360'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_profile
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '2161727821137838080'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_storage
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '432345564227567616'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_system
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1585267068834414592'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_tenant
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1008806316530991104'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: resource_type_user
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '0'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_read_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(f) FROM filesystem_lookup_one($1) f;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_read_private_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(f) FROM filesystem_lookup_private_one($1) f;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_read_user_private_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: userid bigint, OUT result filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT * FROM filesystem_lookup_user_private_one($1) INTO result;
    PERFORM set_path_to_fs(result);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_rlock_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(f) FROM filesystem_lookup_rlock($1) f;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_to_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: filesystem, OUT result filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    result := $1;
    PERFORM set_path_to_fs($1.fs_id, $1.version, $1.type::VARCHAR);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_to_fs
Schema: pod
Result Data Type: void
Argument Data Types: fs_id bigint, version integer, fs_type character varying
Volatility: volatile
Language: c
Source Code:
set_path_to_fs
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_wlock_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(f) FROM filesystem_lookup_lock($1) f;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_wlock_fs
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, size bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_wlock_fs($1);
    SELECT assert_under_quota($1, $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_wlock_private_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(w) FROM wlock_private_fs($1) w;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_path_wlock_shared_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_to_fs(w) FROM wlock_shared_fs($1) w;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_recovered_version_for_new_share
Schema: pod
Result Data Type: void
Argument Data Types: old_fs_recover_version bigint, new_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_rec_ver BIGINT;
    fs_schema_name VARCHAR;
    is_share_or_team boolean;
BEGIN
    SELECT type IN ('SHARED', 'TEAM') FROM filesystem WHERE fs_id = new_fsid INTO is_share_or_team;
    -- if the old_fs_recover_version is set for the old_fs then old_fs may be in recovery
    -- so we need to set shared/team folder fs's recovered_version as well to allow recovery operations
    IF is_share_or_team AND old_fs_recover_version IS NOT NULL THEN
        SELECT xid + 1 FROM filesystem where fs_id = new_fsid INTO new_rec_ver;
        UPDATE filesystem SET recovered_version = new_rec_ver WHERE fs_id = new_fsid AND recovered_version IS NULL;
        fs_schema_name := fsid_to_schema(new_fsid);
        EXECUTE $q$ SELECT setval($1, $2) $q$
            USING fs_schema_name || '.version_id_seq', new_rec_ver;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: set_up_extended_upgrade_states_table
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    CREATE TABLE IF NOT EXISTS extended_upgrade_states(
        fs_id bigint NOT NULL, 
        complete BOOLEAN DEFAULT FALSE, 
        primary key(fs_id)
    );

    TRUNCATE extended_upgrade_states;
    PERFORM populate_extended_upgrade_states_table();
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_accept_invitation
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: fsid bigint, userid bigint, clientid bigint, sync boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sf_membership_result shared_folder_membership;
    shared_fs filesystem;
    new_mountpoint VARCHAR;
BEGIN
    -- lookup and lock both filesystems
    PERFORM set_path_wlock_private_fs(userid);  -- lock the sharee's private filesystem first, and set path
    shared_fs := wlock_shared_fs(fsid);           -- lock the shared folder filesystem second

    -- check limit on number of joined shared folders
    PERFORM limit_joined_shared_folders(count + 1) FROM
        (SELECT COUNT(*) FROM shared_folder_membership m, filesystem f
            WHERE m.user_id = userid AND m.state = 'MEMBER' 
                AND m.fs_id = f.fs_id AND f.owner_id &lt;&gt; userid) AS c;

    -- update the share membership table
    UPDATE shared_folder_membership SET state = 'MEMBER'
        WHERE fs_id = fsid AND user_id = userid AND state = 'INVITED'
        RETURNING * INTO sf_membership_result;
    IF sf_membership_result.fs_id IS NULL THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;
    DELETE FROM shared_folder_membership
        WHERE fs_id = fsid AND user_id = userid AND state IN ('FORMER_MEMBER', 'FORMER_INVITEE');

    UPDATE filesystem
        SET invited_count = invited_count - 1, joined_count = joined_count + 1
        WHERE fs_id = fsid
        RETURNING * INTO shared_fs;

    
    IF shared_fs.type = 'TEAM'::filesystem_type AND 
            sf_membership_result.role = 'MANAGER'::shared_folder_membership_role THEN
        PERFORM tf_update_manager_counts(fsid, -1, 1);
    END IF;
    
    -- create the mountpoint in the sharee's filesystem
    EXECUTE $q$
        SELECT * FROM directory_create_mountpoint($1, '/', $2, $3, $4)
    $q$ USING fsid, shared_fs.label, clientid, sync INTO new_mountpoint;
    IF new_mountpoint IS NULL THEN
       RAISE EXCEPTION 'MOUNTPOINT NOT CREATED: %', fsid; -- should never happen, but just in case
    END IF;
    
    RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, sf_membership_result);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_accessible_shared_folders_with_private_data
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE state &lt;&gt; 'DELETED'::filesystem_state
           AND type = 'SHARED'::filesystem_type
           AND owner_id = $1
           AND (cray_time IS NULL OR cray_time &gt; shared_time);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_copy_path
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: src_fsid bigint, src_path character varying, src_name character varying, dest_fsid bigint, dest_path character varying, client_id bigint, create_conflict boolean, event version_event, args character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    src_resolved_path resolved_path;
    src_resolved_full_path VARCHAR;
    src_resolved_fsid BIGINT;
    src_resolved_fs filesystem;
    dest_resolved_path resolved_path;
    dest_resolved_full_path VARCHAR;
    dest_resolved_fsid BIGINT;
    dest_resolved_fs filesystem;
    source_fs filesystem;
    dest_fs filesystem;
    mountpoint mount_point_result;
    mounted_fs filesystem;
    locked_dest_fs BOOLEAN;
    copy_result dir_entry_result;
    dest_mountpoints mount_point_result ARRAY;
    src_result RECORD;
    dest_result RECORD;
    result RECORD;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();
    -- Lock filesystems in the correct order
    IF src_fsid &lt; dest_fsid THEN
        SELECT * FROM resolve_path_lock_int(src_fsid, full_path(src_path, src_name), FALSE) INTO src_result;
        SELECT * FROM resolve_path_lock_int(dest_fsid, dest_path, TRUE) INTO dest_result;
    ELSE
        SELECT * FROM resolve_path_lock_int(dest_fsid, dest_path, TRUE) INTO dest_result;
        SELECT * FROM resolve_path_lock_int(src_fsid, full_path(src_path, src_name), FALSE) INTO src_result;
    END IF;

    source_fs := src_result.locked_fs;
    src_resolved_path := src_result.result;
    src_resolved_fsid := src_resolved_path.fs_id;
    src_resolved_full_path := full_path(src_resolved_path.parent, src_resolved_path.name);

    dest_fs := dest_result.locked_fs;
    dest_resolved_path := dest_result.result;
    dest_resolved_fsid := dest_resolved_path.fs_id;
    dest_resolved_full_path := full_path(dest_resolved_path.parent, dest_resolved_path.name);
    
    -- Make sure the target path isn't in the source one
    PERFORM entry_copy_restrict(src_resolved_fsid, src_resolved_path.parent, src_resolved_path.name,
                                dest_resolved_fsid, dest_resolved_full_path);
                                
    PERFORM check_can_write(client_id, dest_resolved_path);

    IF dest_fsid = dest_resolved_fsid THEN
        -- Copying to a private filesystem which we already locked
        locked_dest_fs := TRUE;
    END IF;

    -- Explicitly set the read path
    PERFORM set_path_read_fs(src_resolved_fsid);

    IF src_fsid = src_resolved_fsid THEN
        -- Copying from a private filesystem, which could have shares
        FOR mountpoint IN EXECUTE $q$
            SELECT * FROM entries_lookup_mountpoints_under_path($1)
                $q$ USING full_path(src_path, src_name)
        LOOP
            IF dest_resolved_fsid = mountpoint.fs_id THEN
                RAISE EXCEPTION 'INVALID COPY DESTINATION : Can not copy fs % from % into itself',
                    dest_resolved_fsid, mountpoint.mounted_path;
            END IF;
            IF locked_dest_fs = FALSE AND dest_resolved_fsid &lt; mountpoint.fs_id THEN
                PERFORM wlock_shared_fs(dest_resolved_fsid);
                locked_dest_fs := TRUE;
            END IF;
            mounted_fs := wlock_shared_fs(mountpoint.fs_id);
            IF mounted_fs.version &lt;&gt; fs_version_latest() THEN
                PERFORM upgrade_filesystem(mounted_fs);
            END IF;
        END LOOP;
    ELSIF locked_dest_fs THEN
        -- Copying from a share the dest is already locked so only lock src
        PERFORM wlock_shared_fs(src_resolved_fsid);
    ELSE
        -- Both are shares so lock them in order
        PERFORM wlock_shared_fs(least(src_resolved_fsid, dest_resolved_fsid));
        PERFORM wlock_shared_fs(greatest(src_resolved_fsid, dest_resolved_fsid));
    END IF;

    src_resolved_fs := filesystem_lookup_one(src_resolved_fsid);
    dest_resolved_fs := filesystem_lookup_one(dest_resolved_fsid);
    
    IF src_resolved_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(src_resolved_fs);
    END IF;
    IF  dest_resolved_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(dest_resolved_fs);
    END IF;

    src_resolved_fs := set_path_read_fs(src_resolved_fsid);
    
    SELECT * FROM entry_copy_path(src_resolved_path.parent, src_resolved_path.name, dest_resolved_fsid, dest_resolved_full_path,
                                  $6, FALSE, $7, $8, $9) INTO result;
    copy_result := result.copy_result;
    dest_mountpoints := result.dest_mountpoints;

    -- copy any shared folders under the path that is moving to the dest mountpoints
    FOREACH mountpoint IN ARRAY dest_mountpoints LOOP
        PERFORM set_path_read_fs(mountpoint.fs_id);
        EXECUTE $q$
            SELECT * FROM entry_copy_all($1, $2, $3, $4, $5, $6, $7)
        $q$ USING dest_resolved_fsid, mountpoint.mounted_path, client_id, FALSE, create_conflict, event, args;
    END LOOP;

    IF copy_result.entry_id IS NOT NULL THEN
        copy_result := unresolve_path(client_id, dest_resolved_path, copy_result);
        PERFORM check_can_write(copy_result);
        RETURN NEXT copy_result;
    END IF;

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_create_invitation
Schema: pod
Result Data Type: invitation
Argument Data Types: fs filesystem, sfm shared_folder_membership
Volatility: immutable
Language: sql
Source Code:

    SELECT $1.fs_id, $1.sum_file_size, $1.label, $2.user_id, $2.inviter_id, $2.role, $2.state, $2.individual;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_decline_invitation
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: fsid bigint, userid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    membership_result shared_folder_membership;
    shared_fs filesystem;
BEGIN
    PERFORM wlock_private_fs(userid);
    shared_fs := set_path_wlock_shared_fs(fsid);
    UPDATE shared_folder_membership SET state = 'FORMER_INVITEE', individual = TRUE
        WHERE fs_id = $1 AND user_id = $2 AND state = 'INVITED'
        RETURNING * INTO membership_result;
    IF membership_result.fs_id IS NULL THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;

    UPDATE filesystem SET invited_count = invited_count - 1 WHERE fs_id = fsid RETURNING * 
        INTO shared_fs;
    
    IF shared_fs.type = 'TEAM'::filesystem_type AND 
            membership_result.role = 'MANAGER'::shared_folder_membership_role THEN
        PERFORM tf_update_manager_counts(fsid, -1, 0);
    END IF;
    
    PERFORM check_last_member_or_invited(shared_fs);

    RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, membership_result);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_delete_entry
Schema: pod
Result Data Type: boolean
Argument Data Types: fsid bigint, path character varying, name character varying, contentid bigint, recursive boolean, client_id bigint, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    arecord RECORD;
    resolved_path resolved_path;
    fullpath VARCHAR := full_path(path, name);
    normalized_fullpath VARCHAR := normalize(fullpath);
    private_fs filesystem;
    shared_fs filesystem;
    mountpoint mount_point_result;
    result BOOLEAN;
    deleting_mountpoint BOOLEAN;
    reset_path BOOLEAN := FALSE;
    owned_mountpoints mount_point_result ARRAY := '{}';
    mount_entry dir_entry_result;
    unique_name VARCHAR;
    unsyncedMoved BOOLEAN := FALSE;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();

    SELECT * FROM resolve_path_lock_int(fsid, fullpath, false) INTO arecord;
    private_fs := arecord.locked_fs;
    resolved_path := arecord.result;
    
    PERFORM check_can_write(client_id, resolved_path);

    IF resolved_path.fs_id = fsid THEN
        -- if a syncing client move any unsynced folders to the root
        IF NOT apply_directory_entry_filter(filter, resolved_path.fs_id, FALSE) THEN
            -- check if path is unsyncing mountpoint and error if it is
            IF NOT (SELECT sync FROM resolve_path(fsid,private_fs.owner_id,fullpath,true)) THEN
                RAISE EXCEPTION 'NONSYNCING SHARE: %', fullpath;
            END IF;
            FOR mountpoint IN EXECUTE $q$
                    SELECT * FROM entries_lookup_mountpoints_under_path($1)
                $q$ USING fullpath LOOP
                IF NOT mountpoint.sync THEN
                    SELECT * FROM directory_lookup_ext(mountpoint.mounted_path, FALSE, FALSE) INTO mount_entry;
                    unique_name := generate_unique_mountpoint_name('/', mount_entry.name);
                    PERFORM entry_rename_prepare(private_fs.fs_id);
                    PERFORM entry_rename(private_fs.fs_id, mount_entry.parent, mount_entry.name, mount_entry.content_id,
                        private_fs.fs_id, '/', unique_name, $6, FALSE, TRUE, FALSE, NULL::TIMESTAMPTZ, NULL::version_event, FALSE);
                    PERFORM entry_rename_cleanup();
                    unsyncedMoved := TRUE;
                END IF;
            END LOOP;
        END IF;
        -- unshare or leave any shared folders under the path that is being deleted
        FOR mountpoint IN EXECUTE $q$
                    SELECT * FROM entries_lookup_mountpoints_under_path($1)
                $q$ USING fullpath LOOP
            deleting_mountpoint := FALSE;
            reset_path := TRUE;
            IF normalized_fullpath = normalize(mountpoint.mounted_path) THEN
                deleting_mountpoint := TRUE;
            END IF;
            -- if an ALL_ENTRIES client and a mobilized share, throw
            IF (filter = 'ALL_ENTRIES'::directory_entry_filter 
                AND fs_is_mobilized(mountpoint.fs_id)) THEN
                -- This will trigger a throw. 
                PERFORM resolve_path(fsid, private_fs.owner_id, mountpoint.mounted_path, TRUE, TRUE);
            END IF;

            shared_fs := filesystem_lookup(mountpoint.fs_id);
            IF recursive = FALSE AND
                ((normalized_fullpath = normalize(mountpoint.mounted_path) AND
                 (shared_fs.file_count &gt; 0 OR shared_fs.dir_count &gt; 0)) OR
                 (normalized_fullpath &lt;&gt; normalize(mountpoint.mounted_path))) THEN
                RAISE EXCEPTION 'DIRECTORY NOT EMPTY: %', fullpath;
            END IF;

            IF shared_fs.owner_id = private_fs.owner_id THEN
                IF fs_is_edp(shared_fs.type) THEN
                    PERFORM edp_filesystem_delete(shared_fs.owner_id, shared_fs.fs_id, client_id);
                    IF deleting_mountpoint THEN
                        RETURN TRUE; -- we're done; nothing left to do
                    END IF;
                ELSE
                    PERFORM sf_unshare_folder_int(private_fs.owner_id, client_id, mountpoint.mounted_path);
                    owned_mountpoints := array_append(owned_mountpoints, mountpoint);
                END IF;
            ELSIF is_last_manager(shared_fs.fs_id, FALSE) AND sf_is_manager(private_fs.owner_id, mountpoint.fs_id) THEN
                SELECT * FROM directory_lookup_ext(mountpoint.mounted_path, FALSE, FALSE) INTO mount_entry;
                IF mount_entry.sync THEN
                    EXECUTE $q$ SELECT * FROM unsync_directory($1, $2, $3) $q$ USING user_extract_id(client_id), client_id, mountpoint.mounted_path INTO mount_entry;
                END IF;
                unique_name := generate_unique_mountpoint_name_if_necessary(mount_entry.parent, mount_entry.name); 
                PERFORM entry_rename_prepare(private_fs.fs_id);
                PERFORM entry_rename(private_fs.fs_id, mount_entry.parent, mount_entry.name, mount_entry.content_id,
                    private_fs.fs_id, '/', unique_name, $6, FALSE, TRUE, FALSE, NULL::TIMESTAMPTZ, NULL::version_event, FALSE);
                PERFORM entry_rename_cleanup();
                unsyncedMoved := TRUE;
                IF deleting_mountpoint THEN
                    RETURN TRUE;
                END IF;
            ELSE
                PERFORM sf_leave(private_fs.owner_id, client_id, mountpoint.mounted_path, TRUE);
                IF deleting_mountpoint THEN
                    RETURN TRUE; -- we're done; nothing left to do
                END IF;
            END IF;
        END LOOP;
        IF reset_path THEN
            PERFORM set_path_to_fs(private_fs.fs_id, private_fs.version,
                private_fs.type::VARCHAR);
        END IF;
    ELSE
        IF NOT apply_directory_entry_filter(filter, resolved_path.fs_id, resolved_path.sync) THEN
            RAISE EXCEPTION 'NONSYNCING SHARE: %', fullpath;
        END IF;
        
        PERFORM set_path_wlock_fs(resolved_path.fs_id);
    END IF;

    EXECUTE $q$SELECT * FROM directory_entry_delete($1, $2, $3, $4, $5)$q$
         USING resolved_path.parent, resolved_path.name, contentid, recursive, client_id
         INTO result;

-- beth in cray:  I believe we don't need this.  The new share/unshare behavior will not hide any events; they all get
-- sent over TQE.  Also, not sure it was ever needed (as unshare copies all versions over, and then delete of the parent
-- dir deletes all entries anyway.
-- The reason for taking out this code is that when restoring a directory, if the dir to restore was a delete of a mountpoint,
-- then we restore from the mountpoint, as opposed to from the private FS.  In this case, we don't want to restore from
-- the mountpoint, as we already copied everything back to the private FS and can restore from the delete versions.
--    FOREACH mountpoint IN ARRAY owned_mountpoints LOOP
--        -- We unshared it above before deleting, the delete record lost the fsid and collapse values; we need to correct this
--        EXECUTE $q$
--            SELECT * FROM directory_update_latest_version($1, TRUE, $2, FALSE)
--        $q$ USING mountpoint.mounted_path, mountpoint.fs_id;
--    END LOOP;

    IF unsyncedMoved THEN
        PERFORM pgq.insert_event('async_task_fast', 'EMAIL_UNSYNCING_SHARE_MOVED',
                        cast(client_id AS text), cast(fullpath AS text), NULL::TEXT,
                        NULL::TEXT, NULL::TEXT);
    END IF;

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;

    RETURN result;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_delete_membership
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: shared_fsid bigint, user_to_remove bigint, client_id bigint, log_leave boolean, allow_last_manager boolean, kick_by_group boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fs filesystem;
    sf_membership_result shared_folder_membership;
BEGIN
    shared_fs := wlock_shared_fs(shared_fsid);

    -- ensure the user leaving is not the owner
    IF shared_fs.owner_id = user_to_remove THEN
        RAISE EXCEPTION 'REMOVE OWNER FROM SHARED FOLDER';
    END IF;
    
    SELECT * FROM shared_folder_membership WHERE fs_id = shared_fsid AND user_id = user_to_remove INTO sf_membership_result;
    
    IF kick_by_group AND sf_membership_result.individual THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    -- delete shared folder membership
    UPDATE shared_folder_membership SET state = 'FORMER_MEMBER', individual = NOT kick_by_group
        WHERE user_id = user_to_remove AND state = 'MEMBER' AND fs_id = shared_fsid
        RETURNING * INTO sf_membership_result;
    IF sf_membership_result.fs_id IS NULL THEN
        RAISE EXCEPTION 'USER NOT MEMBER';
    END IF;
    
    IF shared_fs.type = 'TEAM'::filesystem_type AND
            sf_membership_result.role = 'MANAGER'::shared_folder_membership_role THEN
        IF  NOT allow_last_manager THEN 
            PERFORM check_last_manager(shared_fsid, TRUE);
        END IF;
        PERFORM tf_update_manager_counts(shared_fsid, 0, -1);
    END IF;

    IF log_leave THEN
        PERFORM sf_log_leave_share(user_to_remove, shared_fs, client_id);
    END IF;

    UPDATE filesystem SET joined_count = joined_count - 1 WHERE fs_id = shared_fsid RETURNING *
        INTO shared_fs;
    PERFORM check_last_member_or_invited(shared_fs);
    RETURN NEXT shared_fs;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_get_invitation_count
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT COUNT(*) FROM shared_folder_membership
        WHERE user_id = $1 AND state = 'INVITED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_get_membership
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: userid bigint, fsid bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM shared_folder_membership WHERE user_id = $1 AND fs_id = $2
        AND state = 'MEMBER'::shared_folder_membership_state;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_get_membership_count
Schema: pod
Result Data Type: bigint
Argument Data Types: userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT count(*) FROM shared_folder_membership WHERE user_id = $1 AND state = 'MEMBER';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_get_size_at_time
Schema: pod
Result Data Type: bigint
Argument Data Types: userid bigint, point_in_time timestamp with time zone, VARIADIC paths character varying[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    mounted_fs filesystem;
    resolved_path resolved_path;
    resolved_subpath resolved_path;
    total_size BIGINT;
    mountpoint_size BIGINT;
    mountpoint mount_point_result;
    result RECORD;
    path VARCHAR;
BEGIN
    private_fs := set_path_read_user_private_fs(userid);

    total_size := 0;

    FOREACH path IN ARRAY paths LOOP
        resolved_path := resolve_path_at_time_read_fs(private_fs.fs_id, path, TRUE, TRUE, point_in_time);
        EXECUTE $q$ SELECT * FROM entry_get_size_at_time ($1, $2, $3) $q$
             USING resolved_path.parent, resolved_path.name, point_in_time
             INTO result;
        total_size := total_size + result.size;
        FOREACH mountpoint IN ARRAY result.mountpoints LOOP
            resolved_subpath := resolve_path_at_time_read_fs(private_fs.fs_id,
                full_path(resolved_path.mountpoint_path, mountpoint.mounted_path), TRUE, FALSE, point_in_time);
            IF resolved_subpath IS NULL THEN
                -- skip unresolvable mountpoints, shouldn't happen anyway
                CONTINUE;
            END IF;
            EXECUTE $q$ SELECT * FROM entry_get_size_at_time($1, $2, $3) $q$
                     USING resolved_subpath.parent, resolved_subpath.name, point_in_time
                     INTO result;
            total_size := total_size + result.size;
            -- you can't have a mountpoint under a mountpoint, so no need to examine result.mountpoints
        END LOOP;
    END LOOP;

    RETURN total_size;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_invite_group
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: authuniquekey character varying, authproviderid bigint, shareid bigint, role shared_folder_membership_role, inviterid bigint, ignore_role boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- make sure the owner is valid
    IF NOT ignore_role AND NOT sf_is_manager(inviterid, shareid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;
    
    DELETE FROM shared_folder_group_membership WHERE auth_unique_key = authuniquekey 
        AND auth_provider_id = authproviderid AND share_id = shareid AND state = 'REMOVED'; 

    RETURN QUERY INSERT INTO shared_folder_group_membership(auth_unique_key, auth_provider_id, share_id, state, 
            role, inviter_id) 
        VALUES (authuniquekey, authproviderid, shareid, 
                'INVITED'::shared_folder_group_membership_state, role, inviterid) RETURNING *;
EXCEPTION WHEN unique_violation THEN
    RAISE EXCEPTION 'SHARED FOLDER RELATIONSHIP EXISTS';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_invite_user
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: inviter_id bigint, shared_fsid bigint, userid bigint, invitee_role shared_folder_membership_role, ignore_role boolean, individual boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fs filesystem;
    membership shared_folder_membership;
BEGIN
    shared_fs := set_path_wlock_shared_fs(shared_fsid);

    -- make sure the owner is valid
    IF NOT ignore_role AND NOT sf_is_manager(inviter_id, shared_fsid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    DELETE FROM shared_folder_membership
        WHERE fs_id = shared_fsid AND user_id = userid AND state IN ('FORMER_MEMBER', 'FORMER_INVITEE');
    UPDATE filesystem SET invited_count = invited_count + 1 WHERE fs_id = shared_fsid;
    INSERT INTO shared_folder_membership (fs_id, user_id, state, role, inviter_id, individual)
        VALUES (shared_fsid, userid, 'INVITED'::shared_folder_membership_state, invitee_role, 
            inviter_id, individual) RETURNING * INTO membership;
    PERFORM pgq.insert_event('async_task_fast', 'EMAIL_SHARED_FOLDER_INVITATION',
        cast(userid AS text), cast(inviter_id AS text), cast(shared_fs.label AS text), NULL::TEXT,
        NULL::TEXT);
    IF shared_fs.type = 'TEAM'::filesystem_type THEN
        PERFORM tf_set_unabandoned(shared_fsid);
        IF invitee_role = 'MANAGER'::shared_folder_membership_role THEN
            PERFORM tf_update_manager_counts(shared_fsid, 1, 0);
        END IF;
    END IF;
    RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, membership);
EXCEPTION WHEN unique_violation THEN
    RAISE EXCEPTION 'SHARED FOLDER RELATIONSHIP EXISTS';
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_accessible_at_past_time
Schema: pod
Result Data Type: boolean
Argument Data Types: fs filesystem, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT $1.fs_id IS NOT NULL
           AND $1.state &lt;&gt; 'DELETED'::filesystem_state
           AND NOT fs_is_mobilized($1.type)
           AND ($1.owner_id = $2 OR sf_is_user_member($2, $1.fs_id));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_accessible_at_past_time
Schema: pod
Result Data Type: boolean
Argument Data Types: fs_id bigint, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT sf_is_accessible_at_past_time(fs, $2) FROM filesystem_lookup_one($1) fs;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_accessible_at_past_time
Schema: pod
Result Data Type: boolean
Argument Data Types: private_fsid bigint, fs filesystem
Volatility: volatile
Language: sql
Source Code:

    SELECT sf_is_accessible_at_past_time($2, pr_fs.owner_id)
        FROM filesystem_lookup_one($1) pr_fs
        WHERE pr_fs.type = 'PRIVATE'::filesystem_type
            AND pr_fs.state = 'ACTIVE'::filesystem_state;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_manager
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, fsid bigint
Volatility: stable
Language: sql
Source Code:

    SELECT EXISTS(SELECT * FROM sf_get_membership($1, $2) 
        WHERE role = 'MANAGER'::shared_folder_membership_role);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_owner
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, fsid bigint
Volatility: stable
Language: sql
Source Code:

    SELECT EXISTS(SELECT * FROM filesystem WHERE owner_id = $1 AND fs_id = $2 AND state = 'ACTIVE');

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_is_user_member
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT fs_id FROM shared_folder_membership
        WHERE user_id = $1 AND fs_id = $2 AND state = 'MEMBER'::shared_folder_membership_state);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_kick_out
Schema: pod
Result Data Type: boolean
Argument Data Types: ownerid bigint, clientid bigint, parent_path character varying, name character varying, user_to_remove bigint, allow_remove_last_manager boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT sf_kick_out($1, $2, fsid, $5, /*kick_by_group*/FALSE, $6) FROM sf_lookup_mounted_fsid_read($1, $3, $4) fsid;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_kick_out
Schema: pod
Result Data Type: boolean
Argument Data Types: performerid bigint, clientid bigint, fsid bigint, user_to_remove bigint, kick_by_group boolean, allow_remove_last_manager boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- make sure the owner of the shared fs is the one that performed the operation
    IF NOT kick_by_group AND NOT sf_is_manager(performerid, fsid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    PERFORM sf_unmount(user_to_remove, fsid, clientid, performerid);

	-- delete the user's membership
	PERFORM sf_delete_membership(fsid, user_to_remove, clientid, FALSE, allow_remove_last_manager, kick_by_group);

    RETURN TRUE;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_leave
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, clientid bigint, path character varying, last_manager_allowed boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fsid BIGINT;
    shared_fs filesystem;
BEGIN
    -- lock the user's private FS and delete the mountpoint at the specified path
    PERFORM set_path_wlock_private_fs(userid);
    EXECUTE $q$
        SELECT fs_id FROM directory_delete_mountpoint_at_path($1, $2)
    $q$ USING path, clientid INTO shared_fsid;

    -- lock the shared fs and delete the user's membership
    SELECT * from filesystem_lookup_one(shared_fsid) INTO shared_fs;
    IF fs_is_mobilized(shared_fs.type) THEN 
        PERFORM raise_mobilized_path((0, '', '', '', FALSE, now(), FALSE, shared_fs.type, NULL, NULL, NULL, NULL)::resolved_path);
    END IF;
    PERFORM sf_delete_membership(shared_fsid, userid, clientid, TRUE, last_manager_allowed, FALSE);
    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_leave_or_unshare
Schema: pod
Result Data Type: void
Argument Data Types: userid bigint, client_id bigint, mounted_fs mounted_filesystem_result
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF (mounted_fs.owner_id = userid AND NOT fs_is_mobilized(mounted_fs.type)) THEN
        PERFORM sf_unshare_folder_int(userid, client_id, mounted_fs.mounted_path);
    ELSE
        PERFORM sf_leave(userid, client_id, mounted_fs.mounted_path, TRUE);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_leave_or_unshare_all
Schema: pod
Result Data Type: void
Argument Data Types: userid bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mounted_fs mounted_filesystem_result;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();

    PERFORM set_path_wlock_private_fs(userid);

    -- The shared folders are returned in fs_id order, so it is safe to lock them in the order
    -- returned
    FOR mounted_fs IN SELECT * from sf_lookup_all_joined_shared_folders(userid, FALSE, FALSE) LOOP
        IF mounted_fs.type = 'SHARED'::filesystem_type THEN
            PERFORM sf_leave_or_unshare(userid, client_id, mounted_fs);
        ELSIF mounted_fs.type = 'TEAM'::filesystem_type THEN
            PERFORM sf_leave(userid, client_id, mounted_fs.mounted_path, TRUE);
        END IF;
    END LOOP;

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_log_leave_share
Schema: pod
Result Data Type: boolean
Argument Data Types: user_id bigint, shared_fs filesystem, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    sharee user_account;
    owner user_account;
    args VARCHAR;
BEGIN
    sharee := user_lookup(user_id);
    IF shared_fs.type = 'TEAM'::filesystem_type THEN
        args := event_args_to_string(sharee.name, shared_fs.label);
        PERFORM event_log_create(10072, user_id, user_id, client_id, shared_fs.fs_id, NULL, 
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity, 
                                 'GENERAL'::event_facility, FALSE, NULL, args);
    ELSE
        owner := user_lookup(shared_fs.owner_id);
        args := event_args_to_string(sharee.name, shared_fs.label, owner.name);
        PERFORM event_log_create(10051, user_id, user_id, client_id, shared_fs.fs_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, args);
        PERFORM event_log_create(10051, owner.user_id, user_id, client_id, shared_fs.fs_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, args);
    END IF; 
    RETURN TRUE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_log_removed_from_share
Schema: pod
Result Data Type: boolean
Argument Data Types: user_id bigint, shared_fsid bigint, client_id bigint, performer_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fs filesystem;
    sharee user_account;
    performer user_account;
    performer_name VARCHAR;
    args VARCHAR;
BEGIN
    shared_fs := filesystem_lookup(shared_fsid);
    sharee := user_lookup(user_id);
    performer := user_lookup(performer_id);
    IF performer.name IS NULL THEN
        performer_name := 'admin'::VARCHAR;
    ELSE
        performer_name := performer.name;
    END IF;
    args := event_args_to_string(sharee.name, shared_fs.label, performer_name);
    IF shared_fs.type = 'TEAM'::filesystem_type THEN
        PERFORM event_log_create(10073, user_id, performer_id, client_id, shared_fs.fs_id, NULL, 
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity, 
                                 'GENERAL'::event_facility, FALSE, NULL, args);
        PERFORM event_log_create(10073, performer_id, performer_id, client_id, 
                                 shared_fs.fs_id, NULL, 'MOBILE_USER'::event_scope, 
                                 'NOTICE'::event_severity, 'GENERAL'::event_facility, FALSE, 
                                 NULL, args);
    ELSE
        PERFORM event_log_create(10052, user_id, performer_id, client_id, shared_fs.fs_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, args);
        PERFORM event_log_create(10052, performer_id, performer_id, client_id, shared_fs.fs_id, NULL,
                                 'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                                 'GENERAL'::event_facility, FALSE, NULL, args);
    END IF; 
    RETURN TRUE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_log_unshare
Schema: pod
Result Data Type: boolean
Argument Data Types: shared_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    owner user_account;
    args VARCHAR;
BEGIN
    owner := user_lookup(shared_fs.owner_id);
    args := event_args_to_string(owner.name, shared_fs.label);
    PERFORM event_log_create(10055, owner.user_id, owner.user_id, NULL, shared_fs.fs_id, NULL,
                             'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                             'GENERAL'::event_facility, FALSE, NULL, args);
    RETURN TRUE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_all_joined_after
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: userid bigint, after_fsid bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    -- look up private and EDP filesystems from the filesystem table directly.
    -- look up shared and team from the shared_folder_membership tables
    -- look up currently mounted mobilized from the user's version table
    SELECT f.* FROM filesystem f
          WHERE owner_id = $1 AND state &lt;&gt; 'DELETED'::filesystem_state
            AND (type = 'PRIVATE'::filesystem_type OR type = 'EDP'::filesystem_type)
            AND fs_id &gt; $2
    UNION
    SELECT f.*  FROM shared_folder_membership m, filesystem f
          WHERE m.user_id = $1 AND m.state &lt;&gt; 'INVITED'::shared_folder_membership_state
            AND m.fs_id = f.fs_id AND f.state &lt;&gt; 'DELETED'::filesystem_state
            AND f.fs_id &gt; $2
    UNION
    SELECT f.* FROM filesystem f, sf_lookup_currently_mounted($1) m
          WHERE f.fs_id = m AND f.state &lt;&gt; 'DELETED'::filesystem_state
            AND fs_is_mobilized(f.type) AND f.fs_id &gt; $2
    ORDER BY fs_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_all_joined_shared_folders
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, synconly boolean, includenscshares boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_read_user_private_fs($1);
    SELECT * FROM sf_lookup_joined_shared_folders($1, NULL::VARCHAR, $2, $3);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_all_owned_after
Schema: pod
Result Data Type: SETOF filesystem
Argument Data Types: userid bigint, after_fsid bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM filesystem
        WHERE owner_id = $1 AND fs_id &gt; $2 AND state &lt;&gt; 'DELETED'::filesystem_state
        ORDER BY fs_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_all_owned_filesystems
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, inc_deleted boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT f.* FROM sf_lookup_all_owned_filesystems_int($1, $2) f ORDER BY f.type, f.fs_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_all_owned_filesystems_int
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, inc_deleted boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    u_state user_state;
    mounted_fs mounted_filesystem_result;
BEGIN
    IF (NOT $2) THEN
        SELECT state FROM user_account WHERE user_id = userid INTO u_state;
    END IF;
    FOR mounted_fs IN
        SELECT f.*, $1, '/'::VARCHAR, TRUE, NULL FROM filesystem f
           WHERE owner_id = $1 AND type = 'PRIVATE'
           AND (($2 AND state &lt;&gt; 'DELETED') OR (state = 'ACTIVE'))
    LOOP
        RETURN NEXT mounted_fs;
        IF ($2 OR u_state = 'ENABLED'::user_state) THEN
            PERFORM set_path_read_fs(mounted_fs.fs_id);
            RETURN QUERY EXECUTE $q$
                SELECT f.*, $1, mp.mounted_path, mp.sync, (CASE f.type WHEN 'SHARED' THEN 'MANAGER' ELSE NULL END)::shared_folder_membership_role
                    FROM filesystem f, directories_lookup_mountpoints(NULL::VARCHAR, $2) mp
                    WHERE f.owner_id = $1 AND (($2 AND f.state &lt;&gt; 'DELETED') OR (f.state = 'ACTIVE'))
                        AND f.type IN ('SHARED', 'EDP') AND f.fs_id = mp.fs_id
            $q$ USING userid, inc_deleted;
        END IF;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_currently_mounted
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: userid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_user_private_fs($1);
    RETURN QUERY EXECUTE $q$
        SELECT * FROM directories_lookup_currently_mounted()
    $q$;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_earliest_restore_point_times
Schema: pod
Result Data Type: SETOF earliest_restore_point_times
Argument Data Types: userid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    daily TIMESTAMPTZ;
    weekly TIMESTAMPTZ;
    monthly TIMESTAMPTZ;
    ts_for_null TIMESTAMPTZ := now() + '1 day'::INTERVAL;
BEGIN
    -- calculate max timestamps for earliest versions across PRIVATE/SHARED filesystems OWNED by this user
    SELECT MAX(coalesce(earliest_daily_version, ts_for_null)),
        MAX(coalesce(earliest_weekly_version, ts_for_null)),
        MAX(coalesce(earliest_monthly_version, ts_for_null))
    FROM filesystem
    WHERE owner_id = $1 AND state = 'ACTIVE'
        AND type in ('PRIVATE', 'SHARED')
    INTO daily, weekly, monthly;

    -- if daily or weekly or monthly timestamp was null for any of the filesystems
    IF GREATEST(daily, weekly, monthly) = ts_for_null THEN
        daily := NULL::TIMESTAMPTZ;
        weekly := NULL::TIMESTAMPTZ;
        monthly := NULL::TIMESTAMPTZ;
    END IF;

    RETURN QUERY SELECT daily, weekly, monthly;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_group_membership
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: auth_unique_key character varying, auth_provider_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_group_membership WHERE auth_unique_key = $1 AND auth_provider_id = $2 AND state = 'INVITED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_group_membership_for_share
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: share_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_group_membership WHERE share_id = $1 AND state = 'INVITED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_group_membership_for_share
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: share_id bigint, auth_provider_id bigint, auth_unique_key character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_group_membership WHERE share_id = $1 AND auth_provider_id = $2 AND auth_unique_key = $3 AND state = 'INVITED';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_group_membership_for_share_paged
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: share_id bigint, group_offset character varying, page_size integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_group_membership WHERE share_id = $1 AND state = 'INVITED' AND (auth_unique_key &gt; $2) ORDER BY auth_unique_key ASC LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_invitations
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT f.fs_id, f.sum_file_size, f.label, m.user_id, m.inviter_id, m.role, m.state, m.individual 
        FROM filesystem f, shared_folder_membership m
            WHERE m.user_id = $1 AND m.state = 'INVITED' AND m.fs_id = f.fs_id;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_joined_shared_folder
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, path character varying
Volatility: volatile
Language: sql
Source Code:

    SELECT set_path_read_user_private_fs($1);
    SELECT * FROM sf_lookup_joined_shared_folders($1, $2, FALSE, FALSE);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_joined_shared_folders
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, path character varying, synconly boolean, includenscshares boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    found_shared BOOLEAN;
BEGIN
    RETURN QUERY EXECUTE $q$
        SELECT f.*, $1, mp.mounted_path, mp.sync, m.role
            FROM shared_folder_membership m, filesystem f,
                 directories_lookup_mountpoints($2, FALSE) mp
            WHERE m.user_id = $1 AND m.state = 'MEMBER'
                AND m.fs_id = mp.fs_id AND f.state = 'ACTIVE' AND f.type in ('SHARED', 'TEAM')
                AND f.fs_id = mp.fs_id AND (mp.sync OR NOT $3 OR $4)
            ORDER BY f.fs_id;
    $q$ USING userid, path, syncOnly, includeNscShares;  
    found_shared := FOUND;
    RETURN QUERY EXECUTE $q$
        SELECT f.*, $1, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role
            FROM filesystem f, directories_lookup_mountpoints($2, FALSE) mp
        WHERE (fs_is_mobilized(f.type) OR fs_is_edp(f.type)) AND f.fs_id = mp.fs_id
            AND NOT $3 ORDER BY f.fs_id;
    $q$ USING userid, path, syncOnly, includeNscShares;
    IF path IS NOT NULL AND NOT FOUND AND NOT found_shared THEN
        RAISE EXCEPTION 'PATH NOT A SHARE: %', path;
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_joined_shared_folders_under_path
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, path character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mounted_fs mounted_filesystem_result;
    normalized_path VARCHAR;
    path_length INT;
    normalized_mountpoint VARCHAR;
BEGIN
    IF path = '/' THEN
        normalized_path := path;
    ELSE
        normalized_path := normalize(path || '/');
    END IF;
    path_length := length(normalized_path);

    FOR mounted_fs IN SELECT * FROM sf_lookup_all_joined_shared_folders(userid, FALSE, FALSE) LOOP
        normalized_mountpoint := normalize(mounted_fs.mounted_path || '/');
        IF length(normalized_mountpoint) &gt;= path_length AND
                substr(normalized_mountpoint, 1, path_length) = normalized_path THEN
            RETURN NEXT mounted_fs;
        END IF;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_membership
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: shared_fsid bigint, include_former boolean
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_membership WHERE fs_id = $1 
        AND ($2 OR (state = 'MEMBER' OR state = 'INVITED'));

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_membership
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: userid bigint, parent_path character varying, name character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fsid BIGINT;
BEGIN
    shared_fsid := sf_lookup_mounted_fsid_read(userid, parent_path, name);
    RETURN QUERY SELECT * FROM sf_lookup_membership(shared_fsid, /*include_former*/ FALSE);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_membership_paged
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: shared_fsid bigint, user_offset bigint, page_size integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_membership WHERE fs_id = $1
        AND (state = 'MEMBER' OR state = 'INVITED') AND (user_id &gt; $2) ORDER BY user_id ASC LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_mounted_fsid_read
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: userid bigint, parent_path character varying, name character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_user_private_fs(userid);
    RETURN QUERY EXECUTE $q$
        SELECT * from directory_lookup_mounted_fsid($1)
    $q$ USING full_path(parent_path, name);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_mounted_fsid_wlock
Schema: pod
Result Data Type: SETOF bigint
Argument Data Types: userid bigint, parent_path character varying, name character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_wlock_private_fs(userid);
    RETURN QUERY EXECUTE $q$
        SELECT * from directory_lookup_mounted_fsid($1)
    $q$ USING full_path(parent_path, name);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_mounted_path
Schema: pod
Result Data Type: character varying
Argument Data Types: userid bigint, fsid bigint
Volatility: stable
Language: plpgsql
Source Code:

DECLARE
    ret VARCHAR;
BEGIN
    PERFORM set_path_read_user_private_fs($1);
    EXECUTE $q$SELECT directory_lookup_mounted_path($1)$q$ INTO ret USING fsid;
    RETURN ret;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_new_joined_shared_folders
Schema: pod
Result Data Type: SETOF mounted_filesystem_result
Argument Data Types: userid bigint, synconly boolean, start timestamp with time zone
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    found_shared BOOLEAN;
BEGIN
    PERFORM set_path_read_user_private_fs($1);
    RETURN QUERY EXECUTE $q$
        SELECT f.*, $1, mp.mounted_path, mp.sync, m.role
            FROM shared_folder_membership m, filesystem f,
                 directories_lookup_new_mountpoints($2) mp
            WHERE m.user_id = $1 AND m.state = 'MEMBER'
                AND m.fs_id = mp.fs_id AND f.state = 'ACTIVE' AND f.type in ('SHARED', 'TEAM')
                AND f.fs_id = mp.fs_id AND (mp.sync OR NOT $3)
            ORDER BY f.fs_id;
    $q$ USING userid, start, syncOnly;    
    RETURN QUERY EXECUTE $q$ 
        SELECT f.*, $1, mp.mounted_path, mp.sync, NULL::shared_folder_membership_role
            FROM filesystem f, directories_lookup_new_mountpoints($2) mp 
        WHERE (fs_is_mobilized(f.type) OR fs_is_edp(f.type)) AND f.fs_id = mp.fs_id 
            AND f.state= 'ACTIVE'::filesystem_state AND NOT $3 ORDER BY f.fs_id;
    $q$ USING userid, start, syncOnly;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_role
Schema: pod
Result Data Type: shared_folder_membership_role
Argument Data Types: user_id bigint, fs_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT role FROM sf_get_membership($1, $2);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_shared_folder_containing_path
Schema: pod
Result Data Type: record
Argument Data Types: userid bigint, normalized_path character varying, OUT result mounted_filesystem_result, OUT normalized_mp character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    mounted_fs mounted_filesystem_result;
    path_length INT;
    mountpoint_length INT;
    normalized_mountpoint VARCHAR;
BEGIN
    path_length := length(normalized_path);

    FOR mounted_fs IN SELECT * FROM sf_lookup_joined_shared_folders(userid, NULL::VARCHAR, FALSE, FALSE) LOOP
        normalized_mountpoint := normalize(mounted_fs.mounted_path || '/');
        mountpoint_length := length(normalized_mountpoint);
        IF mountpoint_length &lt;= path_length AND
                left(normalized_path, mountpoint_length) = normalized_mountpoint THEN
            result := mounted_fs;
            normalized_mp := normalized_mountpoint;
            RETURN;
        END IF;
    END LOOP;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_lookup_user_membership
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: userid bigint, fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM shared_folder_membership sfm WHERE sfm.fs_id = $2 AND sfm.user_id = $1 
        AND state NOT IN ('FORMER_MEMBER', 'FORMER_INVITEE');

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_move_entry
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fsid bigint, src_path character varying, src_name character varying, src_contentid bigint, dest_path character varying, dest_name character varying, client_id bigint, make_dirs boolean, create_conflict boolean, allow_move_share_under_share boolean, filter directory_entry_filter
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    v record;
    src_resolved_path resolved_path;
    src_fsid BIGINT;
    dest_resolved_path resolved_path;
    dest_fsid BIGINT;
    private_fs filesystem;
    src_fs filesystem;
    dest_fs filesystem;
    shared_fs filesystem;
    mountpoint mount_point_result;
    move_result dir_entry_result;
    unsyncedMoved BOOLEAN := FALSE;
    mount_entry dir_entry_result;
    unique_name VARCHAR;
    dest_mountpoints mount_point_result ARRAY;
    locked_dest_fs BOOLEAN := FALSE;
    performed_move BOOLEAN := FALSE;
    result RECORD;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();
    PERFORM entry_rename_restrict(full_path(src_path, src_name), dest_path);

    SELECT * FROM resolve_path_lock_int(fsid, full_path(src_path, src_name), false, FALSE) 
        INTO result;
    private_fs := result.locked_fs;
    src_resolved_path := result.result;
    src_fsid = src_resolved_path.fs_id;
    
    PERFORM check_can_write(client_id, src_resolved_path);

    SELECT * FROM resolve_path_lock_int(fsid, full_path(dest_path, dest_name), false, FALSE) 
        INTO result;
    dest_resolved_path := result.result;
    dest_fsid = dest_resolved_path.fs_id;
    
    PERFORM check_can_write(client_id, dest_resolved_path);
    
    src_fs := filesystem_lookup_one(src_fsid);
    dest_fs := filesystem_lookup_one(dest_fsid);
    IF fs_is_mobilized(src_fs.type) OR fs_is_mobilized(dest_fs.type) THEN
        PERFORM raise_mobilized_rename(src_resolved_path, dest_resolved_path);
    END IF;

    IF NOT apply_directory_entry_filter(filter, dest_resolved_path.fs_id, dest_resolved_path.sync) THEN
        -- the filter is SYNCING_ONLY but the dest path is not syncing
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(dest_resolved_path.parent, dest_resolved_path.name);
    END IF;
    IF NOT apply_directory_entry_filter(filter, src_resolved_path.fs_id, src_resolved_path.sync
        AND (SELECT sync FROM resolve_path(fsid, user_extract_id(client_id), 
            full_path(src_path, src_name), true, false))) THEN
        -- the filter is SYNCING_ONLY, but resolved src path (resolving both with and without resolving mountpoints) is not syncing
        RAISE EXCEPTION 'NONSYNCING SHARE: %', full_path(src_resolved_path.parent, src_resolved_path.name);
    END IF;

    IF src_fsid = fsid AND src_fsid &lt;&gt; dest_fsid THEN
        IF fs_is_edp(dest_fs.type) THEN
            RAISE 'MOVE DESTINATION IS EDP SHARE';
        END IF;

        -- private FS to shared FS move: unshare any owned shared folders under the path that is moving
        FOR mountpoint IN EXECUTE $q$
                    SELECT * FROM entries_lookup_mountpoints_under_path($1)
                $q$ USING full_path(src_path, src_name) LOOP
            IF NOT allow_move_share_under_share THEN
                RAISE EXCEPTION 'NESTED SHARE: false, %, %', dest_fsid, mountpoint.fs_id;
            END IF;
            IF NOT apply_directory_entry_filter(filter, mountpoint.fs_id, mountpoint.sync) 
                    OR (is_last_manager(mountpoint.fs_id, FALSE) AND sf_is_manager(private_fs.owner_id, mountpoint.fs_id)) THEN
                -- the filter is SYNCING_ONLY but the mountpoint is not syncing, or is last manager of a team folder
                SELECT * FROM directory_lookup_ext(mountpoint.mounted_path, FALSE, FALSE) INTO mount_entry;
                IF mount_entry.sync THEN
                    -- we want to unsync the mountpoint
                    EXECUTE $q$ SELECT * FROM unsync_directory($1, $2, $3) $q$ USING user_extract_id(client_id), client_id, mountpoint.mounted_path INTO mount_entry;
                END IF;
                -- if we're in the root already, don't generate a unique mountpoint since it won't conflict with itself
                unique_name := generate_unique_mountpoint_name_if_necessary(mount_entry.parent, mount_entry.name);
                PERFORM entry_rename_prepare(private_fs.fs_id);
                SELECT (er.move_result).* FROM entry_rename(private_fs.fs_id, mount_entry.parent, mount_entry.name, mount_entry.content_id,
                    private_fs.fs_id, '/', unique_name, $7, FALSE, TRUE, FALSE, NULL::TIMESTAMPTZ, NULL::version_event, FALSE) er INTO move_result;
                PERFORM entry_rename_cleanup();
                unsyncedMoved := TRUE;
                performed_move := mountpoint.mounted_path = full_path(src_path, src_name);
            ELSE
                IF locked_dest_fs = FALSE AND dest_fsid &lt; mountpoint.fs_id THEN
                    PERFORM wlock_shared_fs(dest_fsid);
                    locked_dest_fs := TRUE;
                END IF;
                shared_fs := filesystem_lookup(mountpoint.fs_id);
                IF shared_fs.owner_id = private_fs.owner_id THEN
                    PERFORM sf_unshare_folder_int(private_fs.owner_id, client_id, mountpoint.mounted_path);
                END IF;
            END IF;
        END LOOP;
        IF locked_dest_fs = FALSE AND dest_fsid &lt; mountpoint.fs_id THEN
            PERFORM wlock_shared_fs(dest_fsid);
        END IF;
    ELSE
        PERFORM set_path_wlock_fs(least(src_fsid, dest_fsid));
        PERFORM set_path_wlock_fs(greatest(src_fsid, dest_fsid));
    END IF;
    
    IF src_fs.version &lt;&gt; dest_fs.version THEN
        PERFORM upgrade_filesystem(src_fs);
        PERFORM upgrade_filesystem(dest_fs);
    END IF;
    
    IF NOT performed_move THEN
        PERFORM set_path_read_fs(src_fsid);
    
        PERFORM entry_rename_prepare(dest_fsid);
        SELECT * FROM entry_rename(
            src_fsid, src_resolved_path.parent, src_resolved_path.name, src_contentid,
            dest_fsid, dest_resolved_path.parent, dest_resolved_path.name,
            client_id, make_dirs, create_conflict, FALSE, NULL::TIMESTAMPTZ, NULL::version_event, FALSE) INTO result;
        move_result := result.move_result;
        dest_mountpoints := result.dest_mountpoints;
        PERFORM entry_rename_cleanup();
        
        IF src_fsid = fsid THEN  -- src is private FS
            IF src_fsid &lt;&gt; dest_fsid THEN
                -- copy any sharee shared folders under the path that is moving to the dest mountpoints, then leave shared folder
                FOREACH mountpoint IN ARRAY dest_mountpoints LOOP
                    IF NOT apply_directory_entry_filter(filter, mountpoint.fs_id, mountpoint.sync) THEN
                        -- the filter is SYNCING_ONLY but the mountpoint is not syncing
                        SELECT * FROM directory_lookup_ext(mountpoint.mounted_path, FALSE, FALSE) INTO mount_entry;
                        PERFORM entry_rename_prepare(private_fs.fs_id);
                        PERFORM entry_rename(private_fs.fs_id, mount_entry.parent, mount_entry.name, mount_entry.content_id,
                            private_fs.fs_id, '/', unique_name, $7, FALSE, TRUE, FALSE, NULL::TIMESTAMPTZ, NULL::version_event, FALSE);
                        PERFORM entry_rename_cleanup();
                        unsyncedMoved := TRUE;
                    ELSE
                        PERFORM set_path_read_fs(mountpoint.fs_id);
                        EXECUTE $q$
                            SELECT * FROM entry_copy_all($1, $2, $3, $4, $5, NULL, NULL)
                        $q$ USING dest_fsid, mountpoint.mounted_path, client_id, make_dirs, create_conflict;
                        PERFORM sf_delete_membership(mountpoint.fs_id, private_fs.owner_id, client_id, TRUE, TRUE, FALSE);
                    END IF;
                END LOOP;
            END IF;
        END IF;

        IF move_result.entry_id IS NOT NULL THEN
            move_result := unresolve_path(client_id, dest_resolved_path, move_result);
        END IF;
    END IF;
    RETURN NEXT move_result;

    IF unsyncedMoved THEN
        PERFORM pgq.insert_event('async_task_fast', 'EMAIL_UNSYNCING_SHARE_MOVED',
                    cast(client_id AS text), cast(full_path(src_path, src_name) AS text), NULL::TEXT,
                    NULL::TEXT, NULL::TEXT);
    END IF;

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_preserve_membership
Schema: pod
Result Data Type: SETOF shared_folder_membership
Argument Data Types: performerid bigint, shareid bigint, remove_groups boolean
Volatility: volatile
Language: plpgsql
Source Code:
 
BEGIN
    IF NOT sf_is_manager(performerid, shareid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    UPDATE shared_folder_group_membership SET state = 'REMOVED' WHERE remove_groups 
        AND share_id = shareid AND state = 'INVITED';   
    RETURN QUERY UPDATE shared_folder_membership SET individual = TRUE WHERE fs_id = shareid 
        AND state IN ('INVITED', 'MEMBER') RETURNING *;
END 

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_promote_file
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: fsid bigint, parent character varying, name character varying, src_fsid bigint, src_version_id bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    dest_resolved_path resolved_path;
    dest_fsid BIGINT;
    fs filesystem;
    src_fs filesystem;
    dest_fs filesystem;
    src_entry dir_entry_result;
    result dir_entry_result;
BEGIN
    fs := filesystem_lookup_one(fsid);
    IF fs.type = 'PRIVATE'::filesystem_type THEN
        dest_resolved_path := resolve_path_read_fs(fsid, full_path(parent, name), FALSE, TRUE);
    ELSE
        -- we were passed in a non-private fs; the path is already &quot;resolved&quot;, but we need permissions
        dest_resolved_path := resolve_share_path_read_fs(fs, client_id, parent, name);
    END IF;

    dest_fsid = dest_resolved_path.fs_id;
    dest_fs := filesystem_lookup_one(dest_fsid);
    src_fs := filesystem_lookup_one(src_fsid);

    IF fs_is_mobilized(src_fs.type) OR fs_is_mobilized(dest_fs.type) THEN
        RAISE EXCEPTION 'MOBILIZED PROMOTE';
    END IF;

    IF src_fsid &lt;&gt; dest_fsid AND fs_is_edp(dest_fs.type) THEN
        RAISE 'PROMOTE DESTINATION IS EDP SHARE';
    END IF;

    PERFORM check_can_write(client_id, dest_resolved_path);

    IF src_fs.version &lt;&gt; dest_fs.version THEN
        PERFORM set_path_wlock_fs(least(src_fsid, dest_fsid));
        PERFORM set_path_wlock_fs(greatest(src_fsid, dest_fsid));
        PERFORM upgrade_filesystem(src_fs);
        PERFORM upgrade_filesystem(dest_fs);
    ELSE
        PERFORM set_path_wlock_fs(dest_fsid);
    END IF;

    -- look up the old version to promote
    PERFORM set_path_read_fs(src_fsid);
    EXECUTE $q$ SELECT * FROM directory_entry_lookup_by_version($1, $2, $3, $4, $5, $6, $7, $8, $9) $q$
        USING src_version_id, TRUE, FALSE, FALSE, 'FILE'::entry_type, FALSE, NULL::BIGINT, NULL::version_event, NULL::VARCHAR
        INTO src_entry;
    IF src_entry.version_id IS NOT NULL THEN
        -- create dest version
        PERFORM set_path_read_fs(dest_fsid);
        EXECUTE $q$
                SELECT * FROM file_restore($1, $2, $3, $4)
            $q$ USING src_entry, dest_resolved_path.parent, dest_resolved_path.name, client_id
            INTO result;

        IF result.entry_id IS NOT NULL THEN
            result := unresolve_path(client_id, dest_resolved_path, result);
            RETURN NEXT result;
        END IF;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_queue_unshared_folder_event
Schema: pod
Result Data Type: SETOF boolean
Argument Data Types: sharee_user_id bigint, shared_fsid bigint, clientid bigint, performerid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
BEGIN
    PERFORM pgq.insert_event('async_task_fast', 'UNMOUNT_FOLDER', cast(sharee_user_id AS text),
        cast(shared_fsid AS text), cast(clientid AS text), cast(performerid AS text), NULL::TEXT);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_remove_group
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: in_auth_unique_key character varying, in_auth_provider_id bigint, in_share_id bigint, performer_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN

    IF NOT (sf_is_manager(performer_id, in_share_id) OR performer_id = user_admin_id()) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    RETURN QUERY UPDATE shared_folder_group_membership SET state = 'REMOVED'::shared_folder_group_membership_state
            WHERE auth_unique_key = in_auth_unique_key AND auth_provider_id = in_auth_provider_id 
                AND share_id = in_share_id AND state = 'INVITED' RETURNING *;
    IF NOT FOUND THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: curr_role shared_folder_membership_role
Volatility: stable
Language: sql
Source Code:

    SELECT sf_resolve_permissions($1, dir_entry_full_perms());

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_resolve_permissions
Schema: pod
Result Data Type: dir_entry_permission[]
Argument Data Types: curr_role shared_folder_membership_role, entry_permissions dir_entry_permission[]
Volatility: stable
Language: sql
Source Code:

    SELECT ARRAY(
       SELECT unnest($2) INTERSECT
           SELECT unnest(
               CASE $1
                   WHEN 'VIEWER'::shared_folder_membership_role THEN
                       dir_entry_ro_perms()
                   ELSE
                       dir_entry_full_perms()
               END
           )
    );

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_share_folder
Schema: pod
Result Data Type: bigint
Argument Data Types: userid bigint, clientid bigint, parent_path character varying, name character varying, label character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_fsid BIGINT;
BEGIN
    new_fsid := fs_next_id();
    PERFORM sf_share_folder_int(userid, clientid, parent_path, name, label, new_fsid, 
        'SHARED'::filesystem_type);
    return new_fsid;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_share_folder_int
Schema: pod
Result Data Type: filesystem
Argument Data Types: userid bigint, clientid bigint, parent_path character varying, name character varying, label character varying, fsid bigint, new_type filesystem_type
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    resolved_fsid BIGINT;
    new_fsid BIGINT;
    dest_version_id BIGINT;
    fullpath VARCHAR := full_path(parent_path, name);
    result RECORD;
    mountpoint mount_point_result;
    child_entry dir_entry_result;
    fs_result filesystem;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();

    -- lock the user's private filesystem
    private_fs := set_path_wlock_private_fs(userid);

    -- the owner must be at the latest filesystem schema version so that the shared fs and the
    -- owner's private fs will be at the same schema version.
    IF private_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(private_fs);
    END IF;

    IF parent_path IS NULL THEN
        RAISE 'PARENT PATH INVALID';
    END IF;

    private_fs := set_path_wlock_private_fs(userid);

    -- check limit on number of owned shared folders
    PERFORM limit_owned_shared_folders(count + 1) FROM
        (SELECT COUNT(*) FROM filesystem
            WHERE owner_id = $1 AND type = 'SHARED' AND state = 'ACTIVE') AS c;

    -- check if we're in a shared folder
    SELECT fs_id FROM resolve_path(private_fs.fs_id, userid, fullpath, FALSE)
        INTO resolved_fsid;
    if resolved_fsid &lt;&gt; private_fs.fs_id THEN
        RAISE EXCEPTION 'NESTED SHARE: true, %', resolved_fsid;
    END IF;

    -- check if we *are* a shared folder
    SELECT fs_id FROM resolve_path(private_fs.fs_id, userid, fullpath, TRUE)
        INTO resolved_fsid;
    if resolved_fsid &lt;&gt; private_fs.fs_id THEN
        RAISE EXCEPTION 'DIRECTORY ALREADY SHARED: %', fullpath;
    END IF;

    -- Check if there are nested shares
    FOR mountpoint IN EXECUTE $q$
            SELECT * FROM entries_lookup_mountpoints_under_path($1)
        $q$ USING fullpath
    LOOP
        RAISE EXCEPTION 'CHILD SHARE EXISTS: %', mountpoint.fs_id;
    END LOOP;

    -- Mark the directory as a share in the filesystem fs  (throws exception on failure).
    -- Returns the new filesystem id
    EXECUTE $q$
        SELECT * FROM directory_share($1, $2, $3)
    $q$ USING fullpath, clientid, fsid INTO result;
    new_fsid := result.share_fsid;
    PERFORM filesystem_update_stats(private_fs.fs_id, 0, 0, 0, 0, result.new_version_id, FALSE);

    -- create a filesystem corresponding to the new share (which also inserts into filesystem table)
    BEGIN
        dest_version_id := create_filesystem(new_fsid, CASE WHEN new_type = 'TEAM'::filesystem_TYPE
            THEN user_admin_id() ELSE userid END, new_type, label, clientid);
    EXCEPTION WHEN unique_violation THEN
        RAISE EXCEPTION 'DUPLICATE LABEL: %', label;
    END;

    -- copy earlist daily/weekly/monthly timestamps FROM private TO new share's filesystem
    UPDATE filesystem fsshare SET
        earliest_daily_version = fsprivate.earliest_daily_version,
        earliest_weekly_version = fsprivate.earliest_weekly_version,
        earliest_monthly_version = fsprivate.earliest_monthly_version
    FROM filesystem fsprivate
    WHERE fsshare.fs_id = new_fsid AND fsprivate.fs_id = private_fs.fs_id;

    -- move entries from the owner's fs to the shared folder fs
    PERFORM set_path_wlock_fs(new_fsid);
    PERFORM set_path_to_fs(private_fs); -- set the path back to owner's fs; already locked
    -- from private fs, update version id seq on shared folder
    EXECUTE $q$ SELECT * FROM dest_schema_version_id_reset($1) $q$ USING new_fsid;
    PERFORM entry_rename_prepare(new_fsid);
    FOR child_entry IN
        SELECT * FROM directory_list(private_fs.fs_id, fullpath, FALSE, FALSE, 'ALL_ENTRIES'::directory_entry_filter, clientid)
    LOOP
        PERFORM entry_rename(private_fs.fs_id, child_entry.parent, child_entry.name, child_entry.content_id,
            new_fsid, '/', child_entry.name, clientid, TRUE, FALSE, FALSE, NULL::TIMESTAMPTZ, 'SHARE'::version_event, TRUE);
    END LOOP;
    PERFORM entry_rename_cleanup();

    -- insert a row into the share membership table for the owner
    INSERT INTO shared_folder_membership (fs_id, user_id, state, role, inviter_id, individual)
        VALUES (new_fsid, userid, 'MEMBER', 'MANAGER'::shared_folder_membership_role, userid, TRUE);

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
    
    -- set the recovered_version column for the new shared folder if it is set for the private fs
    PERFORM set_recovered_version_for_new_share(private_fs.recovered_version, new_fsid);

    fs_result := filesystem_lookup_one(fsid);
    RETURN fs_result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_shared_folder_metrics
Schema: pod
Result Data Type: record
Argument Data Types: OUT sf_count bigint, OUT sf_membership_count bigint, OUT sf_tot_files bigint, OUT sf_tot_file_size bigint
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    SELECT COUNT(*)::BIGINT, COALESCE(SUM(joined_count), 0)::BIGINT, 
        COALESCE(SUM(file_count), 0)::BIGINT, COALESCE(SUM(sum_file_size), 0)::BIGINT 
        FROM filesystem
        WHERE state = 'ACTIVE' AND type = 'SHARED' 
        INTO sf_count, sf_membership_count, sf_tot_files, sf_tot_file_size;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_sync_share
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- lock the user's private filesystem
    PERFORM set_path_wlock_private_fs(userid);

    RETURN QUERY EXECUTE $q$ SELECT * FROM sync_directory($1, $2, $3); $q$ using userid, clientid, fullpath;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_uninvite
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: ownerid bigint, parent_path character varying, name character varying, userid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT sf_uninvite($1, fsid, $4, /*uninvite_by_group*/ FALSE) FROM sf_lookup_mounted_fsid_wlock($1, $2, $3) fsid;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_uninvite
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: performerid bigint, fsid bigint, userid bigint, uninvite_by_group boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    membership_result shared_folder_membership;
    shared_fs filesystem;
BEGIN
    -- lock the private fs and then the shared fs
    shared_fs := set_path_wlock_shared_fs(fsid);

    -- make sure the owner is valid if provided
    IF NOT uninvite_by_group AND NOT sf_is_manager(performerid, fsid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;
    
    SELECT * FROM shared_folder_membership WHERE fs_id = fsid AND user_id = userid INTO membership_result;
    
    IF uninvite_by_group AND membership_result.individual THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    UPDATE shared_folder_membership SET state = 'FORMER_INVITEE', individual = NOT uninvite_by_group
        WHERE fs_id = fsid AND user_id = userid AND state = 'INVITED'
        RETURNING * INTO membership_result;
    IF membership_result.fs_id IS NULL THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;
    
    IF shared_fs.type = 'TEAM'::filesystem_type AND 
            membership_result.role = 'MANAGER'::shared_folder_membership_role THEN
        PERFORM tf_update_manager_counts(fsid, -1, 0);
    END IF;
    PERFORM check_last_member_or_invited(shared_fs);
    UPDATE filesystem SET invited_count = invited_count - 1 WHERE fs_id = fsid;
    RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, membership_result);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_unmount
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, shared_fsid bigint, clientid bigint, performerid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN

    -- lock the user's private FS and delete the mountpoint in the sharee's fs
    PERFORM set_path_wlock_private_fs(userid);
    EXECUTE $q$
        SELECT directory_delete_mountpoint_to_fs($1, $2)
    $q$ USING shared_fsid, clientid;
    PERFORM sf_log_removed_from_share(userid, shared_fsid, clientid, performerid);

    RETURN TRUE;
EXCEPTION
   WHEN raise_exception THEN
       IF SQLERRM = 'FILESYSTEM MOUNT POINT NOT FOUND' THEN
            RAISE EXCEPTION 'USER NOT MEMBER';
       ELSE
            RAISE EXCEPTION '%', SQLERRM; -- let it bubble up
       END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_unshare_folder
Schema: pod
Result Data Type: boolean
Argument Data Types: ownerid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    shared_fsid BIGINT;
    shared_fs  filesystem;
    sharee_user_id BIGINT;
    result RECORD;
    child_entry dir_entry_result;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();

    PERFORM sf_unshare_folder_int(ownerid, clientid, fullpath);

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_unshare_folder_int
Schema: pod
Result Data Type: boolean
Argument Data Types: ownerid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    shared_fsid BIGINT;
    shared_fs  filesystem;
    sharee_user_id BIGINT;
    result RECORD;
    child_entry dir_entry_result;
    mountpoint_create_time TIMESTAMPTZ;
BEGIN
    -- lock the user's private filesystem, and set path to it
    private_fs := set_path_wlock_private_fs(ownerid);

    -- change owner's mount to shared folder to be a regular folder.  Also makes sure the path is
    -- mounted and returns the mounted filesystem
    EXECUTE $q$
        SELECT * FROM directory_unshare($1, $2)
    $q$ USING fullpath, clientid INTO result;
    shared_fsid := result.share_fsid;
    mountpoint_create_time = result.mountpoint_create_time;
    PERFORM filesystem_update_stats(private_fs.fs_id, 0, 0, 0, 0, result.new_version_id, FALSE);

    -- lock the shared filesystem
    shared_fs := set_path_wlock_shared_fs(shared_fsid);

    -- make sure the passed in owner is really the owner
    IF NOT sf_is_manager(ownerid, shared_fs.fs_id) THEN
        RAISE EXCEPTION 'UNSHARE FOLDER BY NONOWNER';
    END IF;
    
    -- make sure both filesystems are at the latest schema version
    IF private_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(private_fs);
    END IF;
    IF shared_fs.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(shared_fs);
    END IF;

    shared_fs := set_path_wlock_shared_fs(shared_fsid);

    -- update earlist daily/weekly/monthly timestamps for private filesystem if necessary
    -- choose the GREATEST value BETWEEN private filesystem and unshared filesystem
    UPDATE filesystem fsprivate SET
        earliest_daily_version = GREATEST(fsprivate.earliest_daily_version, fsshare.earliest_daily_version),
        earliest_weekly_version = GREATEST(fsprivate.earliest_weekly_version, fsshare.earliest_weekly_version),
        earliest_monthly_version = GREATEST(fsprivate.earliest_monthly_version, fsshare.earliest_monthly_version)
    FROM filesystem fsshare
    WHERE fsshare.fs_id = shared_fsid AND fsprivate.fs_id = private_fs.fs_id;

    -- from the shared folder, update version id seq on the private filesystem
    EXECUTE $q$ SELECT * FROM dest_schema_version_id_reset($1) $q$ USING private_fs.fs_id;

    -- Mark the filesystem inactive, this needs to be done before entry_rename
    PERFORM filesystem_mark_inactive(shared_fs.fs_id);

    -- move entries from the shared folder fs to the owner's fs
    PERFORM entry_rename_prepare(private_fs.fs_id);
    FOR child_entry IN
        SELECT * FROM directory_list(shared_fsid, '/', TRUE, TRUE, 'ALL_ENTRIES'::directory_entry_filter, clientid)
    LOOP
        PERFORM entry_rename(shared_fsid, child_entry.parent, child_entry.name, child_entry.content_id,
            private_fs.fs_id, fullpath, child_entry.name, clientid, TRUE, FALSE, TRUE, mountpoint_create_time,
            'UNSHARE'::version_event, TRUE);
    END LOOP;
    PERFORM entry_rename_cleanup();

    -- file/dir stats on the filesystem were set to 0 by marking it inactive earlier, entry_rename logic
    -- can turn file/dir stats negative, so mark it inactive again to set them back to 0
    PERFORM filesystem_mark_inactive(shared_fs.fs_id);
    
    -- clean up any requests
    PERFORM request_delete(shared_fs.fs_id);

    -- delete all membership info, and queue async unshares for sharees
    FOR sharee_user_id IN SELECT user_id FROM shared_folder_membership
        WHERE fs_id = shared_fs.fs_id AND user_id &lt;&gt; ownerid AND state = 'MEMBER' LOOP
        PERFORM sf_queue_unshared_folder_event(sharee_user_id, shared_fs.fs_id, clientid, ownerid);
    END LOOP;
    UPDATE shared_folder_membership SET state = 'FORMER_MEMBER'
        WHERE fs_id = shared_fs.fs_id AND state = 'MEMBER';
    DELETE FROM shared_folder_membership
        WHERE fs_id =  shared_fs.fs_id AND state = 'INVITED';

    PERFORM sf_log_unshare(shared_fs);

    RETURN TRUE;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_unsync_share
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: userid bigint, clientid bigint, fullpath character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    -- lock the user's private filesystem
    PERFORM set_path_wlock_private_fs(userid);

    RETURN QUERY EXECUTE $q$ SELECT * FROM unsync_directory($1, $2, $3); $q$ using userid, clientid, fullpath;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_update_group_membership
Schema: pod
Result Data Type: SETOF shared_folder_group_membership
Argument Data Types: in_auth_unique_key character varying, in_auth_provider_id bigint, in_share_id bigint, in_role shared_folder_membership_role, performer_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF NOT sf_is_manager(performer_id, in_share_id) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;

    RETURN QUERY UPDATE shared_folder_group_membership SET role = in_role
            WHERE auth_unique_key = in_auth_unique_key AND auth_provider_id = in_auth_provider_id 
                AND share_id = in_share_id AND state = 'INVITED' RETURNING *;
    IF NOT FOUND THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_update_membership
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: performerid bigint, fsid bigint, userid bigint, invitee_role shared_folder_membership_role, ignore_role boolean, in_individual boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fs filesystem;
    invitee_membership shared_folder_membership;
    manager_count INTEGER;
    membership shared_folder_membership;
    invitee_portal_client_id BIGINT;
    entry dir_entry_result;
BEGIN
    -- lock the private fs and then the shared fs
    shared_fs := set_path_wlock_shared_fs(fsid);

    -- make sure the owner is valid
    IF NOT ignore_role AND NOT sf_is_manager(performerid, fsid) THEN
        RAISE EXCEPTION 'PERMISSION DENIED';
    END IF;
    
    invitee_membership := sf_lookup_user_membership(userid, fsid);
    IF invitee_membership.role = invitee_role THEN
        RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, invitee_membership);
        RETURN;
    END IF;

    -- disallow removing the last manager of a share    
    if invitee_membership.role = 'MANAGER'::shared_folder_membership_role 
            AND invitee_role != 'MANAGER'::shared_folder_membership_role THEN
        PERFORM check_last_manager(fsid, FALSE);
    END IF;
    
    IF shared_fs.type = 'TEAM'::filesystem_type THEN
        IF invitee_membership.state = 'INVITED'::shared_folder_membership_state THEN
            IF invitee_role = 'MANAGER'::shared_folder_membership_role THEN
                PERFORM tf_update_manager_counts(fsid, 1, 0);
            ELSIF invitee_membership.role = 'MANAGER'::shared_folder_membership_role THEN
                PERFORM tf_update_manager_counts(fsid, -1, 0);
            END IF;
        ELSIF invitee_membership.state = 'MEMBER'::shared_folder_membership_state THEN
            IF invitee_role = 'MANAGER'::shared_folder_membership_role THEN
                PERFORM tf_update_manager_counts(fsid, 0, 1);
            ELSIF invitee_membership.role = 'MANAGER'::shared_folder_membership_role THEN
                PERFORM tf_update_manager_counts(fsid, 0, -1);
            END IF;
        END IF;
    END IF;
    
    IF invitee_membership.user_id IS NULL THEN
        RAISE EXCEPTION 'USER NOT INVITED';
    END IF;

    -- If the user has this share syncing, unsync it --
    IF invitee_role = 'VIEWER'::shared_folder_membership_role 
            AND invitee_membership.state = 'MEMBER'::shared_folder_membership_state THEN
        PERFORM set_path_wlock_private_fs(userid);
        EXECUTE $q$ SELECT * FROM entry_lookup_by_fs_result($1) $q$ USING fsid INTO entry;
        IF (entry.sync) THEN
            invitee_portal_client_id := client_gen_id(userid, client_portal_sub_id());
            PERFORM sf_unsync_share(userid, invitee_portal_client_id, full_path(entry.parent, entry.name));
        END IF;
    END IF;

    UPDATE shared_folder_membership sfm SET role = invitee_role, individual = in_individual OR sfm.individual
        WHERE sfm.user_id = userid AND sfm.fs_id = fsid AND sfm.state NOT IN ('FORMER_MEMBER', 'FORMER_INVITEE')
        RETURNING * INTO membership;
    IF invitee_membership.state = 'MEMBER'::shared_folder_membership_state THEN
        PERFORM user_increment_xid(userid);
    END IF;
    RETURN QUERY SELECT * FROM sf_create_invitation(shared_fs, membership);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_update_membership
Schema: pod
Result Data Type: SETOF invitation
Argument Data Types: performerid bigint, parent_path character varying, name character varying, userid bigint, invitee_role shared_folder_membership_role, ignore_role boolean, individual boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    shared_fsid BIGINT;
BEGIN
    shared_fsid := sf_lookup_mounted_fsid_wlock(performerid, parent_path, name);
    RETURN QUERY SELECT * FROM sf_update_membership(performerid, shared_fsid, userid, invitee_role, 
        ignore_role, individual);
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: sf_was_user_ever_member
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint, fsid bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT EXISTS(SELECT fs_id FROM shared_folder_membership
        WHERE user_id = $1 AND fs_id = $2 AND state NOT IN ('INVITED', 'FORMER_INVITEE'));

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: storage_create
Schema: pod
Result Data Type: SETOF storage
Argument Data Types: storage_type storage_type, config character varying
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO storage(storage_id, storage_type, config, xid)
        (SELECT storage_next_id, $1, $2, xid_next(storage_next_id)
            FROM storage_next_id()) RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: storage_list
Schema: pod
Result Data Type: SETOF storage
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM storage;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: storage_lookup
Schema: pod
Result Data Type: SETOF storage
Argument Data Types: storage_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM storage where storage_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: storage_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('storage_id_seq') | resource_type_storage();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: storage_update
Schema: pod
Result Data Type: SETOF storage
Argument Data Types: storage_id bigint, xid bigint, upd_config character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE storage SET config = $3, xid = xid_next($1)
        WHERE storage_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: system_id_lookup
Schema: pod
Result Data Type: SETOF system_id_xid
Argument Data Types: system_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM system_id_xid WHERE id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: system_id_setting
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '1585267068834414593'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: system_id_update
Schema: pod
Result Data Type: SETOF system_id_xid
Argument Data Types: system_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE system_id_xid SET xid = xid_next($1) WHERE id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: team_folder_metrics
Schema: pod
Result Data Type: record
Argument Data Types: OUT team_folder_count bigint, OUT team_folder_members bigint, OUT team_folder_capacity bigint, OUT team_folder_reserved bigint, OUT team_folder_usage bigint, OUT team_folder_file_count bigint, OUT team_folder_abandoned_count bigint, OUT team_folder_abandoned_usage bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    SELECT count(*), coalesce(sum(joined_count), 0), coalesce(sum(tf.quota), 0), 
            coalesce(sum(sum_file_size), 0), coalesce(sum(file_count), 0) 
        FROM filesystem fs, team_folder tf 
        WHERE tf.fs_id = fs.fs_id AND fs.state = 'ACTIVE'::filesystem_state
        INTO team_folder_count, team_folder_members, team_folder_reserved, team_folder_usage, 
            team_folder_file_count;
    SELECT count(*), coalesce(sum(sum_file_size), 0) FROM filesystem fs, team_folder tf 
        WHERE tf.fs_id = fs.fs_id AND fs.state = 'ACTIVE'::filesystem_state 
            AND abandoned IS NOT NULL
        INTO team_folder_abandoned_count, team_folder_abandoned_usage;
    SELECT tf_get_capacity() INTO team_folder_capacity;
END 

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_count
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT count(*) FROM tenant;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_create
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: name character varying, description character varying, hostname character varying, username character varying, password character varying, replica_domain character varying, total_space bigint, public_address character varying, replica_public_address character varying
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY INSERT INTO tenant (tenant_id, name, description, hostname, username, password, 
                                     replica_domain, total_space, space_allocated, xid, public_address, replica_public_address)
        (SELECT tenant_next_id, $1, $2, $3, $4, $5, $6, $7, 0, xid_next(tenant_next_id), $8, $9
            FROM tenant_next_id()) RETURNING *;
EXCEPTION
    WHEN unique_violation THEN -- throw meaningful exception
        RAISE EXCEPTION 'TENANT NAME CONFLICT : %', name;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_delete
Schema: pod
Result Data Type: bigint
Argument Data Types: tenant_id bigint
Volatility: volatile
Language: sql
Source Code:

    DELETE FROM tenant WHERE tenant_id = $1 RETURNING xid_next($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_find
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: pattern character varying, max integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant WHERE normalize(name) LIKE normalize($1) || '%' ORDER BY normalize(name) LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_is_missing_public_addr
Schema: pod
Result Data Type: boolean
Argument Data Types: tenant tenant
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    RETURN (tenant.public_address IS NULL OR length(tenant.public_address) = 0 OR
           (tenant.replica_domain IS NOT NULL AND length(tenant.replica_domain) &gt; 0 AND
               (tenant.replica_public_address IS NULL OR length(tenant.replica_public_address) = 0)));
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_list
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: start character varying, max integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant WHERE normalize(name) &gt; normalize($1) ORDER BY normalize(name) LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_lookup
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenant_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant WHERE tenant_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_lookup
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenant_id character varying
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant WHERE normalize(name) = normalize($1);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT nextval('tenant_id_seq') | resource_type_tenant();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_page
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: skip integer, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant 
        ORDER BY normalize(name) LIMIT $2 OFFSET $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_reserve_space
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenant_id bigint, xid bigint, reserve bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE tenant SET space_allocated = space_allocated + $3, xid = xid_next($1)
        WHERE tenant_id = $1 AND xid = $2 AND space_allocated + $3 &lt;= total_space
        RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_update
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenantid bigint, xxid bigint, newname character varying, newdescription character varying, newhostname character varying, new_replica_domain character varying, new_public_address character varying, new_replica_public_address character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    old_ten tenant;
    new_ten  tenant;
    internal_addr_changed BOOLEAN;
    external_addr_changed BOOLEAN;
BEGIN
    -- Must be first: take the HDI config lock, so NO config changes to ANY HDI device/template
    -- are made while this is happening
    PERFORM hdi_config_lock();

    SELECT * FROM tenant WHERE tenant_id = $1 AND xid = $2 INTO old_ten;
    UPDATE tenant SET name = $3, description = $4, hostname = $5, replica_domain = $6, public_address = $7,
            replica_public_address = $8, xid = xid_next($1)
        WHERE tenant_id = $1 AND xid = $2 RETURNING * INTO new_ten;

    IF old_ten.tenant_id IS NOT NULL AND new_ten.tenant_id IS NOT NULL THEN
        -- update HDI devices and templates to reflect the changed tenant config
        internal_addr_changed := value_changed(old_ten.hostname, new_ten.hostname) OR
            value_changed(old_ten.replica_domain, new_ten.replica_domain);
        external_addr_changed := value_changed(old_ten.public_address, new_ten.public_address) OR
            value_changed(old_ten.replica_public_address, new_ten.replica_public_address);
        PERFORM hdi_device_tenant_updated(new_ten.tenant_id, internal_addr_changed, external_addr_changed, tenant_is_missing_public_addr(new_ten));
        RETURN NEXT new_ten;
    END IF;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_update_account
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenant_id bigint, xid bigint, username character varying, password character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE tenant SET username = $3, password = $4, xid = xid_next($1)
        WHERE tenant_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_update_space
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: tenant_id bigint, total_space bigint, space_allocated bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE tenant SET total_space = $2, space_allocated = $3, xid = xid_next($1)
        WHERE tenant_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_used_by
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: owner namespace_owner
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM tenant WHERE 
        ($1 = 'SYSTEM'::namespace_owner AND has_system_ns)
        OR ($1 = 'MOBILE'::namespace_owner AND has_mobile_ns)
        OR ($1 = 'REMOTE'::namespace_owner AND has_remote_ns);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tenant_used_by
Schema: pod
Result Data Type: SETOF tenant
Argument Data Types: VARIADIC owners namespace_owner[]
Volatility: stable
Language: sql
Source Code:

	SELECT * FROM tenant WHERE 
        ('SYSTEM'::namespace_owner = ANY($1) AND has_system_ns)
        OR ('MOBILE'::namespace_owner = ANY($1) AND has_mobile_ns)
        OR ('REMOTE'::namespace_owner = ANY($1) AND has_remote_ns);


Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_abandon
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: fsid bigint, userid bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    tfolder team_folder;
BEGIN
    tfolder := tf_abandon_int(fsid, userid, client_id);
    IF tfolder.fs_id IS NOT NULL THEN
        RETURN QUERY SELECT (tf_create_result(tfolder, fs)).* FROM filesystem fs WHERE fs_id = $1;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_abandon_int
Schema: pod
Result Data Type: SETOF team_folder
Argument Data Types: fs_id bigint, userid bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    usr user_account;
    fs filesystem;
    tfolder team_folder;
    sharee_user_id BIGINT;
BEGIN
    usr := user_lookup(userid);
    IF usr.user_id IS NOT NULL AND usr.state = 'ENABLED'::user_state THEN
        PERFORM wlock_private_fs(userid);
    END IF;
    fs := set_path_wlock_fs(fs_id);
    IF fs.state = 'ACTIVE'::filesystem_state THEN
        FOR sharee_user_id IN SELECT user_id FROM shared_folder_membership sfm
            WHERE sfm.fs_id = $1 AND sfm.state = 'MEMBER' LOOP
            IF sharee_user_id = userid THEN
                IF usr.user_id IS NOT NULL AND usr.state = 'ENABLED'::user_state THEN
                    PERFORM sf_unmount(userid, fs_id, client_id, userid);
                END IF;
            ELSE
                PERFORM sf_queue_unshared_folder_event(sharee_user_id, fs_id, client_id, userid);
            END IF;
        END LOOP;
        UPDATE shared_folder_membership sfm SET state = 'FORMER_MEMBER'::shared_folder_membership_state 
            WHERE sfm.fs_id = $1 AND sfm.state = 'MEMBER';
        DELETE FROM shared_folder_membership sfm WHERE sfm.fs_id = $1 AND sfm.state = 'INVITED';
        
        UPDATE filesystem f SET invited_count = 0, joined_count = 0 WHERE f.fs_id = $1;
        RETURN QUERY SELECT * FROM tf_set_abandoned(fs_id);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_archive_delete_before
Schema: pod
Result Data Type: void
Argument Data Types: fsid bigint, archive_age timestamp with time zone, archivesize bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_wlock_fs(fsid);
    EXECUTE $q$ SELECT * FROM archive_delete_before($1) $q$ USING archive_age;
    -- drop filesystem, mark it deleted - if it's inactive and empty
    PERFORM archive_empty_filesystem(fsid);
    UPDATE team_folder 
    SET archive_timestamp = archive_age, archive_size = coalesce(archive_size, 0) + archivesize, 
        xid = xid + 1, need_optimize = (archivesize &gt; 0) 
    WHERE fs_id = fsid;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_check_capacity_exceeded
Schema: pod
Result Data Type: void
Argument Data Types: change bigint
Volatility: volatile
Language: plpgsql
Source Code:
 
DECLARE
    capacity BIGINT;
    reserved BIGINT;
BEGIN
    IF change &gt; 0 THEN
        capacity := tf_get_capacity();
        reserved := tf_get_reserved_capacity();
        PERFORM assert_under_limit(reserved + change, capacity, 'CAPACITY EXCEEDED', 
            (reserved + change - capacity)::VARCHAR);
    END IF;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_clear_optimize
Schema: pod
Result Data Type: void
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE team_folder SET need_optimize = FALSE WHERE fs_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_convert_share
Schema: pod
Result Data Type: team_folder_filesystem
Argument Data Types: fsid bigint, requester_id bigint, quota bigint, contact character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    capacity BIGINT;
    reserved BIGINT;
    to_convert filesystem;
    clientid BIGINT;
    new_fsid BIGINT;
    child_entry dir_entry_result;
    membership shared_folder_membership;
    mountpoint dir_entry_result;
    new_fs filesystem;
    tf team_folder;
    result team_folder_filesystem;
    should_commit BOOLEAN;
BEGIN
    should_commit := object_prepare_ordered_update();
    
    -- check limit on number of joined shared folders
    PERFORM limit_joined_shared_folders(count + 1) FROM
        (SELECT COUNT(*) FROM shared_folder_membership m, filesystem f
            WHERE m.user_id = requester_id AND m.state = 'MEMBER'
                AND m.fs_id = f.fs_id AND f.owner_id &lt;&gt; requester_id) AS c;

    -- verify enough capacity to create team folder
    PERFORM tf_check_capacity_exceeded(quota);

    to_convert := filesystem_lookup_one(fsid); -- lookup owner
    
    -- can only convert active shared folders
    IF to_convert.fs_id IS NULL OR to_convert.state &lt;&gt; 'ACTIVE' OR to_convert.type &lt;&gt; 'SHARED' THEN
        RAISE EXCEPTION 'FILESYSTEM NOT SHARED';
    END IF;
    
    PERFORM set_path_wlock_private_fs(to_convert.owner_id); -- lock private fs
    to_convert := set_path_wlock_fs(fsid); -- lock shared fs

    -- can only convert latest version filesystems
    IF to_convert.version &lt;&gt; fs_version_latest() THEN
        PERFORM upgrade_filesystem(fsid);
    END IF;

    clientid := client_gen_id(to_convert.owner_id, client_portal_sub_id());

    -- create filesystem
    new_fsid := fs_next_team_id();
    PERFORM create_filesystem(new_fsid, user_admin_id(), 'TEAM'::filesystem_type, to_convert.label, 
        clientid);
    
    -- queue event to remount the new filesystem for everyone at the same location
    FOR membership IN SELECT * FROM shared_folder_membership 
        WHERE fs_id = fsid AND state = 'MEMBER' ORDER BY fs_id LOOP
        IF membership.user_id = to_convert.owner_id THEN
            PERFORM tf_replace_mountpoint(membership.user_id, fsid, new_fsid);
        ELSE
            PERFORM tf_queue_remount_folder_event(membership.user_id, fsid, new_fsid);
        END IF;
    END LOOP;

    -- copy latest events
    PERFORM set_path_wlock_fs(fsid);
    -- from the shared folder, update version id seq on the team folder
    EXECUTE $q$ SELECT * FROM dest_schema_version_id_reset($1) $q$ USING new_fsid;

    -- Mark the filesystem inactive, this needs to be done before entry_rename
    PERFORM filesystem_mark_inactive(fsid);

    PERFORM entry_rename_prepare(new_fsid);
    FOR child_entry IN
        SELECT * FROM directory_list(fsid, '/', TRUE, TRUE, 'ALL_ENTRIES'::directory_entry_filter, clientid)
    LOOP
        PERFORM entry_rename(fsid, child_entry.parent, child_entry.name, child_entry.content_id,
            new_fsid, '/', child_entry.name, clientid, TRUE, FALSE, TRUE, now(), NULL::version_event, TRUE);
    END LOOP;
    PERFORM entry_rename_cleanup();

    -- file/dir stats on the filesystem were set to 0 by marking it inactive earlier, entry_rename logic
    -- can turn file/dir stats negative, so mark it inactive again to set them back to 0
    PERFORM filesystem_mark_inactive(fsid);

    -- update earliest versions
    UPDATE filesystem fs_team SET
        earliest_daily_version = fs_share.earliest_daily_version,
        earliest_weekly_version = fs_share.earliest_weekly_version,
        earliest_monthly_version = fs_share.earliest_monthly_version
    FROM filesystem fs_share
    WHERE fs_team.fs_id = new_fsid AND fs_share.fs_id = fsid;

    -- update invitations
    WITH members AS (
        UPDATE shared_folder_membership new SET state = 'FORMER_MEMBER'::shared_folder_membership_state
            FROM shared_folder_membership old 
            WHERE new.user_id = old.user_id AND new.fs_id = old.fs_id AND new.fs_id = fsid 
                AND new.state &lt;&gt; 'FORMER_MEMBER'::shared_folder_membership_state 
            RETURNING new.*, old.state AS oldstate
        )
    INSERT INTO shared_folder_membership(fs_id, user_id, state, role, inviter_id, individual) 
        SELECT new_fsid, members.user_id, members.oldstate, members.role, members.inviter_Id, 
            members.individual FROM members;

    -- update filesystem membership info
    WITH mc AS (
        SELECT count(*) FROM shared_folder_membership WHERE fs_id = new_fsid AND state = 'MEMBER'
    ), ic AS (
        SELECT count(*) FROM shared_folder_membership WHERE fs_id = new_fsid AND state = 'INVITED'
    )
    UPDATE filesystem SET joined_count = mc.count, invited_count = ic.count FROM mc, ic WHERE fs_id = new_fsid;
            
    -- create team folder row
    INSERT INTO team_folder(soft_quota_exceeded, quota, contact, fs_id, manager_invited_count, 
            manager_joined_count, xid) 
        VALUES (false, $3, $4, new_fsid, 0, 1, 0) RETURNING * INTO tf;

    IF should_commit THEN
        PERFORM object_commit_ordered_update();
    END IF;
    
    -- set the recovered_version column for the new team folder if it is set for the shared fs
    PERFORM set_recovered_version_for_new_share(to_convert.recovered_version, new_fsid);

    new_fs := filesystem_lookup_one(new_fsid);
    result := tf_create_result(tf, new_fs);
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_create_result
Schema: pod
Result Data Type: team_folder_filesystem
Argument Data Types: tf team_folder, fs filesystem
Volatility: immutable
Language: sql
Source Code:

    SELECT $1.*, $2.sum_file_size, $2.file_count, $2.dir_count, $2.conflict_count, $2.label, 
        $2.joined_count, $2.invited_count;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_create_team_folder
Schema: pod
Result Data Type: team_folder_filesystem
Argument Data Types: userid bigint, clientid bigint, parent_path character varying, name character varying, label character varying, quota bigint, contact character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_fsid BIGINT;
    new_fs filesystem;
    tf team_folder;
    result team_folder_filesystem;
BEGIN
    PERFORM tf_check_capacity_exceeded(quota);
    new_fsid := fs_next_team_id();
    
    -- check limit on number of joined shared folders
    PERFORM limit_joined_shared_folders(count + 1) FROM
        (SELECT COUNT(*) FROM shared_folder_membership m, filesystem f
            WHERE m.user_id = userid AND m.state = 'MEMBER'
                AND m.fs_id = f.fs_id AND f.owner_id &lt;&gt; userid) AS c;

    new_fs := sf_share_folder_int(userid, clientid, parent_path, name, label, new_fsid, 
        'TEAM'::filesystem_type);

    INSERT INTO team_folder(soft_quota_exceeded, quota, contact, fs_id, manager_invited_count, 
        manager_joined_count, xid) VALUES (false, $6, $7, new_fsid, 0, 1, 0) RETURNING * INTO tf;

    new_fs := filesystem_lookup_one(new_fsid);
    result := tf_create_result(tf, new_fs);
    RETURN result;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_delete
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: fs_id bigint, userid bigint, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs filesystem;
    tfolder team_folder;
BEGIN
    tfolder := tf_abandon_int(fs_id, userid, client_id);
    IF tfolder.fs_id IS NOT NULL THEN 
        fs := set_path_wlock_fs(fs_id);
        EXECUTE 'SELECT delete_all($1, FALSE)' USING client_id;
        fs := filesystem_mark_inactive(fs_id);
        RETURN QUERY SELECT * FROM tf_create_result(tfolder, fs);
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_evaluate_soft_quota
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: soft_quota_percentage bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE team_folder tf SET soft_quota_exceeded = over_soft_quota(tf.quota, $1, fs.sum_file_size), 
        xid = tf.xid + 1 
    FROM filesystem fs WHERE tf.fs_id = fs.fs_id AND fs.state = 'ACTIVE'::filesystem_state
        AND tf.soft_quota_exceeded &lt;&gt; over_soft_quota(tf.quota, $1, fs.sum_file_size)
    RETURNING (tf_create_result(tf, fs)).*

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_get_capacity
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT cast(value AS BIGINT) FROM pod_config WHERE key = 'team_folder.capacity';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_get_reserved_capacity
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT cast(coalesce(sum(t.quota), 0) AS BIGINT) FROM filesystem fs, team_folder t
        WHERE t.fs_id = fs.fs_id AND fs.state = 'ACTIVE'::filesystem_state;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_list
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT tf_create_result(tf, fs) FROM team_folder tf, filesystem fs WHERE tf.fs_id = fs.fs_id 
        AND fs.state = 'ACTIVE'::filesystem_state;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_list_batch
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: fs_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM tf_list() WHERE fs_id &gt; $1 ORDER BY fs_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_list_entries_for_archive
Schema: pod
Result Data Type: SETOF dir_entry_result
Argument Data Types: filesystem_id bigint, archive_age timestamp with time zone, last_version_id bigint, max_results integer
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    PERFORM set_path_read_fs(filesystem_id);
    IF last_version_id IS NULL THEN
        last_version_id = 0;
    END IF;
    RETURN QUERY EXECUTE $q$
        SELECT * FROM activity_archive_list($1, $2, $3)
        $q$ USING archive_age, last_version_id, max_results;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_list_shares_for_archive
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: before_timestamp timestamp with time zone, last_team_folder_id bigint, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT tf_create_result(tf, fs) FROM team_folder tf, filesystem fs
        WHERE tf.fs_id &gt; $2 AND (archive_timestamp IS NULL OR archive_timestamp &lt; $1) 
            AND tf.fs_id = fs.fs_id AND fs.state &lt;&gt; 'DELETED'::filesystem_state
        ORDER BY tf.fs_id LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_list_shares_for_optimize
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: last_team_folder_id bigint, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT tf_create_result(tf, fs) FROM team_folder tf, filesystem fs
        WHERE tf.fs_id &gt; $1 AND tf.need_optimize = TRUE AND tf.fs_id = fs.fs_id
        ORDER BY tf.fs_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_lookup
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: fs_id bigint
Volatility: volatile
Language: sql
Source Code:

    SELECT (tf_create_result(tf, fs)).* FROM team_folder tf, filesystem fs 
        WHERE tf.fs_id = $1 AND tf.fs_id = fs.fs_id AND fs.state = 'ACTIVE';

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_queue_remount_folder_event
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint, old_fsid bigint, new_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    PERFORM pgq.insert_event('async_task_fast', 'REMOUNT_FOLDER', cast(user_id AS text),
        cast(old_fsid AS text), cast(new_fsid AS text), NULL::TEXT, NULL::TEXT);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_replace_mountpoint
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint, old_fsid bigint, new_fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    clientid BIGINT;
    mountpoint dir_entry_result;
BEGIN
    PERFORM set_path_wlock_private_fs(user_id);
    clientid := client_gen_id(user_id, client_portal_sub_id());
    EXECUTE $q$
        SELECT * FROM directory_delete_mountpoint_to_fs($1, $2)
    $q$ USING old_fsid, clientid INTO mountpoint;
    EXECUTE $q$
        SELECT * FROM directory_create_mountpoint($1, $2, $3, $4, $5)
    $q$ USING new_fsid, mountpoint.parent, mountpoint.name, clientid, mountpoint.sync; 
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_set_abandoned
Schema: pod
Result Data Type: team_folder
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE team_folder tf SET manager_invited_count = 0, manager_joined_count = 0, abandoned = now() 
        WHERE tf.fs_id = $1 RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_set_unabandoned
Schema: pod
Result Data Type: team_folder
Argument Data Types: fsid bigint
Volatility: volatile
Language: sql
Source Code:
 
    UPDATE team_folder tf SET abandoned = NULL WHERE tf.fs_id = $1 AND abandoned IS NOT NULL 
        RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_update
Schema: pod
Result Data Type: SETOF team_folder_filesystem
Argument Data Types: fs_id bigint, quota bigint, contact character varying, xid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    tfolder team_folder;
    fs filesystem;
BEGIN
    PERFORM tf_check_capacity_exceeded($2 - tf.quota) FROM team_folder tf WHERE tf.fs_id = $1;
    UPDATE team_folder tf SET quota = $2, contact = $3 , xid = $4 + 1
        WHERE tf.fs_id = $1 AND tf.xid = $4 RETURNING * 
        INTO tfolder;
    SELECT * FROM filesystem_lookup(fs_id) INTO fs;
    IF fs.state = 'ACTIVE'::filesystem_state AND tfolder.fs_id IS NOT NULL THEN
        RETURN QUERY SELECT * FROM tf_create_result(tfolder, fs);
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: tf_update_manager_counts
Schema: pod
Result Data Type: void
Argument Data Types: fsid bigint, invited_change integer, joined_change integer
Volatility: volatile
Language: sql
Source Code:

    UPDATE team_folder SET manager_invited_count = manager_invited_count + $2, 
            manager_joined_count = manager_joined_count + $3 
        WHERE fs_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: tsextra_next
Schema: pod
Result Data Type: smallint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT cast(NEXTVAL('event_log_tsextra_seq') % 32767 AS SMALLINT);

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unresolvable_path
Schema: pod
Result Data Type: resolved_path
Argument Data Types: path character varying, throw boolean
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF throw THEN
        SET LOCAL log_min_messages TO PANIC;
        RAISE EXCEPTION 'PATH UNRESOLVABLE IN PAST:  %', path;
    END IF;
    RETURN NULL;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unresolve_path
Schema: pod
Result Data Type: dir_entry_result
Argument Data Types: client_id bigint, mount_point mounted_filesystem_result, d dir_entry_result, OUT result dir_entry_result
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    result := unresolve_path($2.fs_id, NULL::TIMESTAMPTZ, $2.mounted_path, resolve_permissions($1, $2, $3), $3);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unresolve_path
Schema: pod
Result Data Type: dir_entry_result
Argument Data Types: client_id bigint, resolved_path resolved_path, d dir_entry_result, OUT result dir_entry_result
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    result := unresolve_path($2.fs_id, $2.unmount_time, $2.mountpoint_path, resolve_permissions($1, $2, $3), $3);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unresolve_path
Schema: pod
Result Data Type: dir_entry_result
Argument Data Types: resolved_fsid bigint, mountpoint character varying, d dir_entry_result, OUT result dir_entry_result
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    result := unresolve_path($1, NULL::TIMESTAMPTZ, $2, NULL::dir_entry_permission[], $3);
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: unresolve_path
Schema: pod
Result Data Type: dir_entry_result
Argument Data Types: resolved_fsid bigint, resolved_fs_unmount_time timestamp with time zone, mountpoint character varying, permissions dir_entry_permission[], d dir_entry_result, OUT result dir_entry_result
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    result := d;
    result.resolved_fsid := $1;
    result.resolved_fs_unmount_time = $2;
    result.parent := path_concat($3, $5.parent);
    result.permissions = $4;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: update_fs_upgrade_attempts
Schema: pod
Result Data Type: void
Argument Data Types: filesystem_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    attempts BIGINT;
BEGIN
    SELECT upgrade_attempts FROM filesystem WHERE fs_id = filesystem_id INTO attempts;
    IF attempts IS NULL THEN
        attempts := 1;
    ELSE
        attempts := attempts + 1;
    END IF;
    UPDATE filesystem SET upgrade_attempts = attempts WHERE fs_id = filesystem_id;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: update_user_to_profile_mapping
Schema: pod
Result Data Type: void
Argument Data Types: user_id_to_update bigint, profile_ids bigint[]
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    id BIGINT;
BEGIN
    IF NOT user_reserve_lock(user_id_to_update) THEN
        RETURN;
    END IF;

    DELETE FROM user_to_profile WHERE user_id = $1 AND profile_id != ALL(profile_ids);

    WITH updated_mappings(profile_id_to_update) AS (
        SELECT unnest($2) AS profile_id_to_update
    ),
    upsert AS
    (
        SELECT up.profile_id AS profile_id
        FROM user_to_profile up, updated_mappings um
        WHERE up.user_id = $1 AND up.profile_id = um.profile_id_to_update
    )
    INSERT INTO user_to_profile (user_id, profile_id)
        SELECT $1, um.profile_id_to_update
        FROM updated_mappings um
        WHERE NOT EXISTS (SELECT 1
                          FROM upsert us
                          WHERE us.profile_id = um.profile_id_to_update);

END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_feature_unavailable_error
Schema: pod
Result Data Type: void
Argument Data Types: 
Volatility: immutable
Language: plpgsql
Source Code:

BEGIN
    RAISE EXCEPTION 'UPGRADE - FEATURE UNAVAILABLE';
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_filesystem
Schema: pod
Result Data Type: void
Argument Data Types: old_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

    DECLARE
        error_stack text;
    BEGIN
        PERFORM upgrade_filesystem_int(old_fs);
        -- If the filesystem version that was upgraded was old, bump up attempts.
        IF old_fs.version &lt; fs_version_latest() THEN
            PERFORM update_fs_upgrade_attempts(old_fs.fs_id);
        END IF;
    EXCEPTION WHEN OTHERS THEN
        GET STACKED DIAGNOSTICS error_stack = PG_EXCEPTION_CONTEXT;
        RAISE EXCEPTION 'ERROR UPGRADING FS: % - % \n %', old_fs.fs_id, SQLERRM, error_stack;
    END;
    
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_filesystem_int
Schema: pod
Result Data Type: void
Argument Data Types: old_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF old_fs.version &lt; fs_version_latest() THEN
        PERFORM log_upgrade_msg('Upgrading filesystem ' || old_fs.fs_id || ' for ownerid ' 
                            || old_fs.owner_id);
        PERFORM set_path_to_fs(old_fs);
        PERFORM upgrade_filesystem_schema(old_fs);
        UPDATE filesystem SET version = fs_version_latest() WHERE fs_id = old_fs.fs_id;
        PERFORM log_upgrade_msg('Updated filesystem version for ' || old_fs.fs_id 
                            || ' from ' || old_fs.version || ' to ' || fs_version_latest());
    END IF;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_filesystem_schema
Schema: pod
Result Data Type: void
Argument Data Types: old_fs filesystem
Volatility: volatile
Language: plpgsql
Source Code:

BEGIN
    IF (old_fs.version &lt; 100 OR NOT does_schema_exist(fsid_to_schema(old_fs.fs_id))) THEN
        PERFORM upgrade_filesystem_schema_v300(old_fs);
    ELSE
        PERFORM log_upgrade_msg('Do not need to perform any upgrading steps of filesystem ' || old_fs.fs_id 
                            || ' for ownerid ' || old_fs.owner_id);
    END IF; 
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========


Name: upgrade_filesystem_schemas
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_row RECORD;
    old_fs filesystem;
BEGIN
    SELECT filesystem.CTID, filesystem FROM filesystem LEFT OUTER JOIN client ON filesystem.owner_id = client.user_id 
    WHERE (filesystem.version &lt; fs_version_latest() OR NOT does_schema_exist(fsid_to_schema(filesystem.fs_id)))
        AND filesystem.state &lt;&gt; 'DELETED'::filesystem_state
        AND (filesystem.upgrade_attempts IS NULL OR filesystem.upgrade_attempts &lt; get_max_fs_upgrade_attempts_config())
        ORDER BY client.last_access DESC NULLS LAST LIMIT 1 INTO fs_row FOR UPDATE OF filesystem;
    IF fs_row.ctid IS NULL THEN
        --verify no failed fs schema upgrade attempts left
        IF failed_fs_upgrade_attempts_exist() THEN
            RAISE EXCEPTION 'FAILED FS UPGRADE ATTEMPTS EXIST';
        END IF;
        --no old schemas left. We're done.
        PERFORM log_upgrade_msg('All filesystems upgraded.');
        RETURN FALSE;
    END IF;

    PERFORM upgrade_filesystem(fs_row.filesystem);
    RETURN TRUE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_filesystem_schemas_phase2
Schema: pod
Result Data Type: boolean
Argument Data Types: 
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    fs_row RECORD;
BEGIN
    SELECT filesystem.CTID, filesystem FROM filesystem LEFT OUTER JOIN client ON filesystem.owner_id = client.user_id
    LEFT OUTER JOIN extended_upgrade_states ON filesystem.fs_id = extended_upgrade_states.fs_id 
    WHERE extended_upgrade_states.complete = FALSE
        AND filesystem.state &lt;&gt; 'DELETED'::filesystem_state
        AND (filesystem.upgrade_attempts IS NULL OR filesystem.upgrade_attempts &lt; get_max_fs_upgrade_attempts_config())
        ORDER BY client.last_access DESC NULLS LAST LIMIT 1 INTO fs_row;
    IF fs_row.ctid IS NULL THEN
        --verify no failed fs schema upgrade attempts left
        IF failed_fs_upgrade_attempts_exist() THEN
            RAISE EXCEPTION 'FAILED FS UPGRADE ATTEMPTS EXIST';
        END IF;
        --no filesystems left. We're done. 
        PERFORM log_upgrade_msg('All filesystems phase 2 upgraded.');
        RETURN FALSE;
    END IF;

    PERFORM additional_extended_upgrade_work(fs_row.filesystem);
    RETURN TRUE;
EXCEPTION WHEN undefined_table THEN
    PERFORM log_upgrade_msg('No filesystem phase 2 upgrade needed.');
    RETURN FALSE;
END;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_history_insert
Schema: pod
Result Data Type: SETOF upgrade_history
Argument Data Types: install_time timestamp with time zone, title character varying, manifest character varying
Volatility: volatile
Language: sql
Source Code:

    INSERT INTO upgrade_history (timestamp, title, manifest) VALUES ($1, $2, $3) returning *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_history_install_date
Schema: pod
Result Data Type: timestamp with time zone
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT MIN(timestamp) FROM upgrade_history;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: upgrade_history_list_all
Schema: pod
Result Data Type: SETOF upgrade_history
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM upgrade_history ORDER BY timestamp DESC;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_admin_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: immutable
Language: sql
Source Code:

            SELECT '144115179687247872'::bigint;
        
Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_clear_optimize
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET need_optimize = FALSE
        WHERE user_id = $1 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_count_visible
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: stable
Language: sql
Source Code:

    SELECT count(*) FROM user_account
        WHERE user_is_visible(state);

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_create
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: auth_unique_key character varying, auth_provider_id bigint, name character varying, display_name character varying, email character varying
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    new_uid BIGINT;
BEGIN
    SELECT user_next_id() INTO new_uid;

    RETURN QUERY INSERT INTO
        user_account(user_id, name, auth_unique_key, profile_hash, effective_quota, effective_client_limit,
                     is_profile_member, profile_overrides, email, email_events, receive_folder_invites, state, sub_id,
                     soft_quota_exceeded, ui_config, xid, display_name, auth_provider_id, external_state, fss_enabled)
        VALUES (new_uid, name, auth_unique_key, NULL, -1, -1, FALSE, NULL, email, NULL, TRUE, 'INITIALIZED',
            2, FALSE, NULL, xid_next(new_uid), display_name, auth_provider_id, 'ACTIVE'::user_external_state, FALSE)
        RETURNING *;
EXCEPTION
    WHEN unique_violation THEN -- We want nothing returned here
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_delete
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: delete_id bigint, wipe boolean, client_id bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    private_fs filesystem;
    owned_fs filesystem;
    filesystem_schema VARCHAR;
    filesystem_new_schema VARCHAR;
    next_fs_id BIGINT;
BEGIN
    -- deleting a user requires taking locks on user owned filesystems of type PRIVATE, SHARED and EDP
    -- get all the filesystem locks upfront, locks must be taken in an ascending order by filesytem id
    FOR owned_fs IN SELECT * FROM filesystem_owned_list(delete_id) LOOP
        IF owned_fs.type in ('PRIVATE', 'SHARED', 'EDP') THEN
            PERFORM filesystem_lookup_lock(owned_fs.fs_id);
        END IF;
    END LOOP;

    -- delete processing
    PERFORM delete_all_user_edp_filesystems(delete_id, client_id);
    PERFORM sf_leave_or_unshare_all(delete_id, client_id);

    -- delete and prune records from all owned filesystems
    FOR owned_fs IN SELECT * FROM filesystem_owned_list(delete_id) LOOP
        IF owned_fs.type in ('PRIVATE', 'SHARED', 'EDP') THEN
            PERFORM set_path_read_fs(owned_fs.fs_id);
            EXECUTE $q$ SELECT delete_all($1, fs_is_private($2)) $q$ USING client_id, owned_fs.type;
        END IF;
    END LOOP;

    private_fs := set_path_read_user_private_fs(delete_id); -- set path back to private fs
    next_fs_id = delete_id | resource_type_filesystem() + user_next_sub_id(delete_id);
    filesystem_schema := fsid_to_schema(private_fs.fs_id);
    filesystem_new_schema := fsid_to_schema(next_fs_id);

    UPDATE filesystem SET sum_file_size = 0, file_count = 0, dir_count = 0,
            conflict_count = 0 WHERE fs_id = private_fs.fs_id;
    PERFORM client_disable_all(delete_id, wipe);
    PERFORM event_log_create(10025, delete_id, delete_id, client_id, private_fs.fs_id, NULL,
                             'MOBILE_USER'::event_scope, 'NOTICE'::event_severity,
                             'GENERAL'::event_facility, FALSE, NULL, NULL);
    EXECUTE 'ALTER SCHEMA ' || filesystem_schema || ' RENAME TO ' || filesystem_new_schema;
    UPDATE filesystem
        SET fs_id = next_fs_id, state = 'INACTIVE'::filesystem_state, inactive_time = statement_timestamp()
        WHERE fs_id = private_fs.fs_id;
    RETURN QUERY UPDATE user_account SET state = 'INITIALIZED', email = NULL, xid = xid_next(user_id),
      kerberos_ticket = NULL, ui_config = NULL
         WHERE user_id = delete_id RETURNING *;
END;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_disable
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET state = 'DISABLED', xid = xid_next($1), kerberos_ticket = NULL
        WHERE user_id = $1 AND state = 'ENABLED' RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_enable
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: upd_user_id bigint, upd_xid bigint, profile_hash character varying, effective_quota bigint, effective_client_limit integer, is_profile_member boolean, profile_overrides character varying, email character varying, email_events character varying, receive_folder_invites boolean
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    versionid BIGINT;
    updated user_account;
    client_acct client;
BEGIN
    PERFORM limit_users(user_count_visible() + 1);
    UPDATE user_account SET profile_hash = $3, effective_quota = $4, effective_client_limit = $5,
            is_profile_member = $6, profile_overrides = $7, email = $8, email_events = $9,
            receive_folder_invites = $10, state = 'ENABLED', xid = xid_next($1),
            enable_time = transaction_timestamp()
        WHERE user_id = upd_user_id AND xid = $2 AND state = 'INITIALIZED' RETURNING * INTO updated;
    IF updated.user_id IS NOT NULL THEN
        SELECT * FROM client_reenable_int(client_gen_id(updated.user_id, client_portal_sub_id()), client_portal_name(),
                client_portal_os(), client_portal_version()) into client_acct;
        IF client_acct.client_id IS NULL THEN
            PERFORM client_create(client_gen_id(upd_user_id, client_portal_sub_id()), upd_user_id,
                client_portal_name(), client_portal_os(), client_portal_version(), '', -1, NULL::VARCHAR, 0,
                'FSS'::client_scope);
        END IF;
        SELECT create_filesystem(upd_user_id | resource_type_filesystem() + 1, upd_user_id,
                                 'PRIVATE'::filesystem_type, NULL::VARCHAR,
                                 client_gen_id(upd_user_id, client_portal_sub_id())) INTO versionid;

        RETURN QUERY SELECT * FROM user_account WHERE user_id = upd_user_id;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_extract_id
Schema: pod
Result Data Type: bigint
Argument Data Types: resource_id bigint
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 &amp; resource_mask_user();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_find
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: pattern character varying, max_results integer, find_invisible boolean
Volatility: stable
Language: plpgsql
Source Code:

BEGIN
    RETURN QUERY
        EXECUTE $q$SELECT * FROM user_account WHERE normalize(name) LIKE $1 AND ($2 OR user_is_visible(state))
            ORDER BY name LIMIT $3$q$
        USING normalize(pattern) || '%', find_invisible, max_results;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_increment_xid
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET xid = xid_next($1)
        WHERE user_id = $1 RETURNING *;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_is_visible
Schema: pod
Result Data Type: boolean
Argument Data Types: user_state
Volatility: immutable
Language: sql
Source Code:

    SELECT $1 = 'ENABLED' OR $1 = 'DISABLED';

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: start character varying, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account WHERE name &gt; $1 ORDER BY name LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_after
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account WHERE user_id &gt; $1 AND state &lt;&gt; 'DELETED'::user_state ORDER BY user_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_for_archive
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: before_timestamp timestamp with time zone, start character varying, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account
        WHERE name &gt; $2 AND (archive_timestamp IS NULL OR archive_timestamp &lt; $1)
        ORDER BY name LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_for_optimize
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: start character varying, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account
        WHERE name &gt; $1 AND need_optimize = TRUE
        ORDER BY name LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_users_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, auth_provider ap
        WHERE ua.user_id &gt; $1 AND ua.auth_provider_id = ap.auth_provider_id
            AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
        ORDER BY ua.user_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_users_with_profile_overrides_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, auth_provider ap
        WHERE ua.user_id &gt; $1 AND ua.auth_provider_id = ap.auth_provider_id
          AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
          AND ua.profile_overrides IS NOT NULL
        ORDER BY ua.user_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_list_visible
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: start character varying, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account
        WHERE name &gt; $1 AND user_is_visible(state)
        ORDER BY name LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_lock
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, lock_holder user_lock_holder
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET lock_holder = $2 WHERE user_id = $1 AND lock_holder IS NULL RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_lookup
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: auth_unique_key character varying, auth_provider_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account WHERE auth_unique_key = $1 AND auth_provider_id = $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_lookup
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account WHERE user_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_next_id
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT (nextval('user_id_seq') &lt;&lt; resource_shift_user()) | resource_type_user();

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_next_sub_id
Schema: pod
Result Data Type: bigint
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET sub_id = sub_id + 1 WHERE user_id = $1
        RETURNING sub_id;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_page_visible
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: skip integer, max_results integer
Volatility: stable
Language: sql
Source Code:

    SELECT * FROM user_account
        WHERE user_is_visible(state)
        ORDER BY name LIMIT $2 OFFSET $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_reenable
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET state = 'ENABLED', xid = xid_next($1)
        WHERE user_id = $1 AND state = 'DISABLED' RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_release_all_locks
Schema: pod
Result Data Type: void
Argument Data Types: lock_holder user_lock_holder
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET lock_holder = NULL WHERE lock_holder = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_release_lock
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET lock_holder = NULL WHERE user_id = $1;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_reserve_lock
Schema: pod
Result Data Type: boolean
Argument Data Types: userid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    usr user_account;
BEGIN
    SELECT * FROM user_account WHERE user_id = $1 AND lock_holder IS NULL FOR UPDATE INTO usr;
    RETURN usr.user_id IS NOT NULL;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: user_search_type
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: pattern character varying, type auth_provider_type
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    rec auth_provider;
    search VARCHAR := concat(normalize(pattern), '%');
BEGIN
    FOR rec IN SELECT * FROM auth_provider_list(type)
    LOOP
        RETURN QUERY EXECUTE $q$
            SELECT * from user_account WHERE auth_provider_id = $1 AND (normalize(name) LIKE $2 OR normalize(display_name) LIKE $2) $q$
                USING rec.auth_provider_id, search;
    END LOOP;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_set_kerberos_ticket
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, xid bigint, kerberos_ticket character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET kerberos_ticket = $3, xid = xid_next($1)
       WHERE user_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_soft_quota_eval
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: quota_percent bigint
Volatility: volatile
Language: sql
Source Code:

    WITH soft_quota(user_id, soft_exceeded) AS (
        SELECT us.user_id, over_soft_quota(effective_quota, $1, us.filesystem_space_used_by)
            FROM user_account, (SELECT user_id, filesystem_space_used_by(user_id, FALSE)
                    FROM user_account) AS us
                    WHERE user_account.user_id = us.user_id
                        AND user_account.effective_quota &gt; 0
                        AND soft_quota_exceeded &lt;&gt; over_soft_quota(effective_quota, $1,
                                us.filesystem_space_used_by)
    ) UPDATE user_account
        SET soft_quota_exceeded = soft_quota.soft_exceeded, xid = xid_next(soft_quota.user_id)
        FROM soft_quota WHERE user_account.user_id = soft_quota.user_id RETURNING user_account.*;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_update
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, xid bigint, email character varying, email_events character varying, receive_folder_invites boolean, locale character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET email = $3, email_events = $4, xid = xid_next($1),
        receive_folder_invites = $5, locale = $6
       WHERE user_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_update
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, xid bigint, name character varying, profile_hash character varying, effective_quota bigint, effective_client_limit integer, is_profile_member boolean, profile_overrides character varying, display_name character varying, email character varying, ui_config character varying, external_state user_external_state, fss_enabled boolean
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET name = $3, profile_hash = $4, effective_quota = $5, effective_client_limit = $6,
                            is_profile_member = $7, profile_overrides = $8,    display_name = $9, email = $10,
                            ui_config = $11, xid = xid_next($1), external_state = $12, fss_enabled = $13
       WHERE user_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_update
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, xid bigint, name character varying, profile_hash character varying, effective_quota bigint, effective_client_limit integer, is_profile_member boolean, profile_overrides character varying, email character varying, email_events character varying, receive_folder_invites boolean, locale character varying, display_name character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET name = $3, profile_hash = $4, effective_quota = $5,
                            effective_client_limit = $6, is_profile_member = $7, profile_overrides = $8, email = $9,
                            email_events = $10, receive_folder_invites = $11, xid = xid_next($1), locale = $12,
                            display_name = $13
       WHERE user_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_update
Schema: pod
Result Data Type: SETOF user_account
Argument Data Types: user_id bigint, xid bigint, uiconfig character varying
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account SET ui_config = $3, xid = xid_next($1)
       WHERE user_id = $1 AND xid = $2 RETURNING *;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: user_update_archive
Schema: pod
Result Data Type: void
Argument Data Types: user_id bigint, archive_age timestamp with time zone, archive_size bigint
Volatility: volatile
Language: sql
Source Code:

    UPDATE user_account
        SET archive_timestamp = $2, archive_space = coalesce(archive_space, 0) + $3,
            need_optimize = ($3 &gt; 0), lock_holder = null
        WHERE user_id = $1;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: users_external_inaccessible_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, auth_provider ap
        WHERE ua.user_id &gt; $1 AND ua.auth_provider_id = ap.auth_provider_id
            AND ua.external_state &lt;&gt; 'ACTIVE'
        ORDER BY ua.user_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: users_inactive_after
Schema: pod
Result Data Type: SETOF inactive_user
Argument Data Types: user_id bigint, seconds integer, max_results integer
Volatility: volatile
Language: sql
Source Code:

    WITH max_user_access(user_id, latest_access) AS (
        SELECT c.user_id, MAX(last_access) latest_access
          FROM client c, user_account u
          WHERE u.user_id &gt; $1
              AND u.state &lt;&gt; 'INITIALIZED'::user_state AND u.state &lt;&gt; 'DELETED'::user_state
              AND u.user_id = c.user_id
          GROUP BY c.user_id
          ORDER BY c.user_id
    ) SELECT u.user_id, u.name, u.email, u.state, u.display_name, a.type, m.latest_access
          FROM user_account u, max_user_access m, auth_provider a
          WHERE u.user_id = m.user_id AND u.auth_provider_id = a.auth_provider_id
              AND ($2 IS NULL OR m.latest_access &lt; now() - ($2 || 'seconds')::INTERVAL)
          ORDER BY u.user_id
          LIMIT $3;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: users_orphaned_after
Schema: pod
Result Data Type: SETOF report_user
Argument Data Types: user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT ua.user_id, ua.name, ua.display_name, ap.type, ua.external_state, ua.profile_overrides, ua.state, ua.fss_enabled
        FROM user_account ua, auth_provider ap
        WHERE ua.user_id &gt; $1 AND ua.auth_provider_id = ap.auth_provider_id
          AND ua.state &lt;&gt; 'INITIALIZED'::user_state AND ua.state &lt;&gt; 'DELETED'::user_state
          AND NOT ua.is_profile_member
        ORDER BY ua.user_id LIMIT $2;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: users_storage_after
Schema: pod
Result Data Type: SETOF user_storage
Argument Data Types: quota_percent integer, include_versions boolean, user_id bigint, max_results integer
Volatility: volatile
Language: sql
Source Code:

    SELECT * FROM (SELECT u.user_id, u.name, u.email, u.state, u.display_name, u.effective_quota, a.type,
            filesystem_space_used_by(u.user_id, FALSE)::BIGINT,
            CASE WHEN $2
                THEN filesystem_space_used_by(u.user_id, TRUE)::BIGINT
                ELSE NULL
            END
            FROM user_account u, auth_provider a
            WHERE u.user_id &gt; $3 AND u.auth_provider_id = a.auth_provider_id
                AND u.state &lt;&gt; 'INITIALIZED'::user_state AND u.state &lt;&gt; 'DELETED'::user_state) us
    WHERE $2 OR us.effective_quota = 0 OR ($1 / 100.0 &lt;= us.filesystem_space_used_by / us.effective_quota::double precision)
    ORDER BY us.user_id LIMIT $4;

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: value_changed
Schema: pod
Result Data Type: boolean
Argument Data Types: old character varying, new character varying
Volatility: immutable
Language: sql
Source Code:

    SELECT ($1 IS NULL AND $2 IS NOT NULL) OR
           ($1 IS NOT NULL AND $2 IS NULL) OR
           ($1 IS NOT NULL AND $2 IS NOT NULL AND normalize($1) &lt;&gt; normalize($2));

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: version_prune
Schema: pod
Result Data Type: void
Argument Data Types: fs_id bigint, prune_age_secs integer, max_versions integer, daily_version_keep_days integer, weekly_version_keep_weeks integer, monthly_version_keep_months integer
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    filesystem filesystem;
BEGIN
    filesystem := set_path_wlock_fs(fs_id);
    -- don't bother trying to lock the owner of a filesystem with no owner IE team folder. it's already locked
    IF filesystem.type &lt;&gt; 'TEAM'::filesystem_type AND NOT user_reserve_lock(filesystem.owner_id) THEN
        RETURN;
    END IF;
    IF NOT fs_is_mobilized(filesystem.type) THEN
        EXECUTE $q$SELECT version_prune($1, $2, $3, $4, $5, $6, $7, fs_is_private($8))$q$
          USING prune_age_secs, max_versions, filesystem.age_prune, filesystem.max_version_prune, 
              daily_version_keep_days, weekly_version_keep_weeks, monthly_version_keep_months, filesystem.type;
    END IF;
END

Type: normal
Security: definer
Owner: awdba
=========== NEXT VALUE ===========

Name: wlock_private_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: userid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result filesystem;
    min_messages VARCHAR;
BEGIN
    SHOW log_min_messages INTO min_messages;
    SET LOCAL log_min_messages TO PANIC;
    SELECT * FROM filesystem
        WHERE owner_id = userid AND type = 'PRIVATE' AND state = 'ACTIVE'
        FOR UPDATE NOWAIT INTO result;
    IF result.fs_id IS NULL THEN
        RAISE EXCEPTION 'FILESYSTEM NOT FOUND';
    END IF;
    EXECUTE $q$ SET LOCAL log_min_messages TO $q$ || min_messages;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: wlock_shared_fs
Schema: pod
Result Data Type: filesystem
Argument Data Types: fsid bigint
Volatility: volatile
Language: plpgsql
Source Code:

DECLARE
    result filesystem;
    min_messages VARCHAR;
BEGIN
    SHOW log_min_messages INTO min_messages;
    SET LOCAL log_min_messages TO PANIC;
    SELECT * FROM filesystem
        WHERE fs_id = fsid AND state = 'ACTIVE' AND type in ('SHARED', 'TEAM', 'EDP')
        FOR UPDATE NOWAIT INTO result;
    IF result.fs_id IS NULL THEN
        RAISE EXCEPTION 'FILESYSTEM NOT FOUND: %', fsid;
    END IF;
    EXECUTE $q$ SET LOCAL log_min_messages TO $q$ || min_messages;
    RETURN result;
END

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: xid_next
Schema: pod
Result Data Type: bigint
Argument Data Types: 
Volatility: volatile
Language: sql
Source Code:

    SELECT xid FROM nextval('xid_seq') xid;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========

Name: xid_next
Schema: pod
Result Data Type: bigint
Argument Data Types: resource_id bigint
Volatility: volatile
Language: sql
Source Code:

    -- The pgq format must match com.hds.aw.model.ResourceXidEvent
    SELECT xid FROM (SELECT pgq.insert_event('resource_xid', cast($1 AS text), cast(xid AS text)), xid
                     FROM nextval('xid_seq') AS xid) AS p;

Type: normal
Security: invoker
Owner: awdba
=========== NEXT VALUE ===========



</span>
    </div>
</div>

<!-- Stderr View -->

</div>
    <script type='text/javascript' src='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/static/js/jquery.js'></script>
    <script type='text/javascript' src='http://b33-34-vm1.lab.archivas.com/grinder/grinderindex/static/bootstrap-3.3.4/js/bootstrap.min.js'></script>
</body>
</html>

