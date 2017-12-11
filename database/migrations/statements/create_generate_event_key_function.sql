CREATE OR REPLACE FUNCTION generate_event_key() RETURNS trigger
LANGUAGE plpgsql AS
$$
DECLARE
  CHARS VARCHAR(62) := '0123456789aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ';
  BASE INTEGER := 62;
  tempId INTEGER;
  result VARCHAR(31);
  r DOUBLE PRECISION;
  q DOUBLE PRECISION;
  tempFrom INTEGER;
  tempQ INTEGER;
BEGIN
  -- Calculate the key if the key is null
  IF NEW.key ISNULL THEN
    -- If the key is not exists.
    tempId := NEW.id;

    r := tempId % BASE;
    q := floor(tempId / BASE);
    tempFrom := floor(r) + 1;
    result := substr(CHARS, tempFrom, 1);

    -- For debug
    RAISE NOTICE '(start) r -> %', r;
    RAISE NOTICE '(start) q -> %', q;
    RAISE NOTICE '(start) tempFrom -> %', tempFrom;
    RAISE NOTICE '(start) result -> %', result;


    WHILE q LOOP
      tempQ = floor(q);
      r := tempQ % BASE;
      q := floor(q / BASE);
      tempFrom := floor(r) + 1;
      result := concat(substr(CHARS, tempFrom, 1), result);

      -- For debug
      RAISE NOTICE '(loop) tempQ -> %', tempQ;
      RAISE NOTICE '(loop) r -> %', r;
      RAISE NOTICE '(loop) q -> %', q;
      RAISE NOTICE '(loop) tempFrom -> %', tempFrom;
      RAISE NOTICE '(loop) result -> %', result;
    END LOOP;

    -- For debug
    RAISE NOTICE '(FINAL) result -> %', result;
    NEW.key := result;
  END IF;

  RETURN NEW;
END;
$$;