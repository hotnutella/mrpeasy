SELECT id, version, content FROM last_versions_table table1 
    WHERE table1.version = (SELECT max(version) FROM last_versions_table table2 WHERE table1.id = table2.id);