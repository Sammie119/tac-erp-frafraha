-- SEQUENCE: public.receive_id_seq

-- DROP SEQUENCE IF EXISTS public.receive_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.receive_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

-- Table: public.receivables

-- DROP TABLE IF EXISTS public.receivables;

CREATE TABLE IF NOT EXISTS public.receivables
(
    id bigint NOT NULL DEFAULT nextval('receive_id_seq'::regclass),
    supplier_id bigint NOT NULL,
    product_id bigint NOT NULL,
    quantity integer NOT NULL,
    unit_price decimal(10, 2) NOT NULL,
    amount decimal(10, 2) NOT NULL,
    description text NOT NULL,
    division bigint NOT NULL,
    created_by_id bigint NOT NULL,
    updated_by_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT receivables_pkey PRIMARY KEY (id),
    CONSTRAINT receivables_created_by_id_foreign FOREIGN KEY (created_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT receivables_division_foreign FOREIGN KEY (division)
    REFERENCES public.system_l_o_v_s (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT receivables_updated_by_id_foreign FOREIGN KEY (updated_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION
    )

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.receivables
    OWNER to postgres;

ALTER SEQUENCE public.receive_id_seq
    OWNED BY public.receivables.id;

ALTER SEQUENCE public.receive_id_seq
    OWNER TO postgres;
