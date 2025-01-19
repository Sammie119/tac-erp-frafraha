-- SEQUENCE: public.stores_transfers_id_seq

-- DROP SEQUENCE IF EXISTS public.stores_transfers_id_seq;

CREATE SEQUENCE IF NOT EXISTS public.stores_transfers_id_seq
    INCREMENT 1
    START 1
    MINVALUE 1
    MAXVALUE 9223372036854775807
    CACHE 1;

ALTER SEQUENCE public.stores_transfers_id_seq
    OWNED BY public.stores_transfers.id;

ALTER SEQUENCE public.stores_transfers_id_seq
    OWNER TO postgres;


-- Table: public.stores_transfers

-- DROP TABLE IF EXISTS public.stores_transfers;

CREATE TABLE IF NOT EXISTS public.stores_transfers
(
    id bigint NOT NULL DEFAULT nextval('stores_transfers_id_seq'::regclass),
    store_transfer_id bigint NOT NULL,
    transfer_date date NOT NULL,
    from_store_id bigint NOT NULL,
    to_store_id bigint NOT NULL,
    product_id bigint NOT NULL,
    transfer_quantity bigint NOT NULL,
    old_stock bigint NOT NULL,
    approved_quantity bigint,
    new_stock bigint,
    status smallint NOT NULL DEFAULT '0'::smallint,
    remarks character varying(400) COLLATE pg_catalog."default",
    division bigint NOT NULL,
    created_by_id bigint NOT NULL,
    updated_by_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT stores_transfers_pkey PRIMARY KEY (id),
    CONSTRAINT stores_transfers_created_by_id_foreign FOREIGN KEY (created_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT stores_transfers_division_foreign FOREIGN KEY (division)
    REFERENCES public.system_l_o_v_s (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION,
    CONSTRAINT stores_transfers_updated_by_id_foreign FOREIGN KEY (updated_by_id)
    REFERENCES public.users (id) MATCH SIMPLE
                            ON UPDATE NO ACTION
                            ON DELETE NO ACTION
)

    TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.stores_transfers
    OWNER to postgres;

COMMENT ON COLUMN public.stores_transfers.status
    IS '0 - pending, 1 - approved, 2 - rejected';
