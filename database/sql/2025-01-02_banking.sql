-- SEQUENCE: public.bankings_id_seq

-- DROP SEQUENCE IF EXISTS public.bankings_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.bankings_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

ALTER SEQUENCE public.bankings_id_seq
    OWNED BY public.bankings.id;

ALTER SEQUENCE public.bankings_id_seq
    OWNER TO postgres;


-- Table: public.bankings

-- DROP TABLE IF EXISTS public.bankings;

CREATE TABLE IF NOT EXISTS public.bankings
(
    id bigint NOT NULL DEFAULT nextval('bankings_id_seq'::regclass),
    start_date date NOT NULL,
    end_date date NOT NULL,
    amount_received numeric(15,2) NOT NULL,
    amount_banked numeric(15,2) NOT NULL,
    image_url character varying(255) COLLATE pg_catalog."default",
    status smallint NOT NULL DEFAULT '0'::smallint,
    remarks character varying(400) COLLATE pg_catalog."default",
    division bigint NOT NULL,
    created_by_id bigint NOT NULL,
    updated_by_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT bankings_pkey PRIMARY KEY (id),
    CONSTRAINT bankings_created_by_id_foreign FOREIGN KEY (created_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT bankings_division_foreign FOREIGN KEY (division)
    REFERENCES public.system_l_o_v_s (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT bankings_updated_by_id_foreign FOREIGN KEY (updated_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION
    )

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.bankings
    OWNER to postgres;

COMMENT ON COLUMN public.bankings.status
    IS '0 - pending, 1 - approved, 2 - rejected';


ALTER TABLE IF EXISTS public.system_l_o_v_s
    ADD COLUMN parent_id integer DEFAULT 0;


