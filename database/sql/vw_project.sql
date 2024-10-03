-- View: public.vw_project

-- DROP VIEW public.vw_project;

CREATE OR REPLACE VIEW public.vw_project
 AS
SELECT project_id,
       name,
       description,
       due_date,
       status,
       division,
       ARRAY( SELECT t.assigned_staff_id
           FROM tasks t
          WHERE t.project_id = p.project_id) AS assigned_staff_arr,
       ( SELECT count(t.task_id) AS count
FROM tasks t
WHERE t.project_id = p.project_id) AS task_count,
    ( SELECT count(t.task_id) AS count
FROM tasks t
WHERE t.project_id = p.project_id AND t.status = 2) AS task_count_completed,
    created_by_id,
    updated_by_id,
    created_at,
    updated_at,
    deleted_at
FROM projects p
WHERE deleted_at IS NULL
ORDER BY project_id;

ALTER TABLE public.vw_project
    OWNER TO postgres;
