-- View: public.vw_users

-- DROP VIEW public.vw_users;

CREATE OR REPLACE VIEW public.vw_users
 AS
SELECT id,
       staff_id,
       get_staff_name(staff_id) AS staff_name,
       email,
       division,
       get_lov_name(division::bigint) AS division_name,
       password,
       remember_token,
       created_by_id,
       updated_by_id,
       created_at,
       updated_at,
       deleted_at
FROM users;
WHERE deleted_at IS NULL;

ALTER TABLE public.vw_users
    OWNER TO postgres;
