<?php

class Tienda
{
    private PDO $db;
    private string $id_tienda = '';
    private string $nombre_tienda = '';
    private ?string $direcc_tienda = null;
    private ?string $ciudad = null;
    private ?string $estado = null;
    private ?string $pais = null;
    private ?string $cod_postal = null;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT id_tienda, nombre_tienda, direcc_tienda, ciudad, estado, pais, cod_postal 
                FROM tiendas 
                ORDER BY nombre_tienda ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array
    {
        $sql = "SELECT id_tienda, nombre_tienda, direcc_tienda, ciudad, estado, pais, cod_postal 
                FROM tiendas 
                WHERE id_tienda = :id 
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => trim($id)]);
        $tienda = $stmt->fetch();

        return $tienda ?: null;
    }

    public function create(array $datos): bool
    {
        $this->asignarYValidar($datos, true);

        if ($this->getById($this->id_tienda) !== null) {
            throw new InvalidArgumentException("Ya existe una tienda registrada con el ID '{$this->id_tienda}'.");
        }

        $sql = "INSERT INTO tiendas (id_tienda, nombre_tienda, direcc_tienda, ciudad, estado, pais, cod_postal)
                VALUES (:id_tienda, :nombre_tienda, :direcc_tienda, :ciudad, :estado, :pais, :cod_postal)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_tienda'     => $this->id_tienda,
            ':nombre_tienda' => $this->nombre_tienda,
            ':direcc_tienda' => $this->direcc_tienda,
            ':ciudad'        => $this->ciudad,
            ':estado'        => $this->estado,
            ':pais'          => $this->pais,
            ':cod_postal'    => $this->cod_postal,
        ]);
    }

    public function update(string $id, array $datos): bool
    {
        $datos['id_tienda'] = $id;
        $this->asignarYValidar($datos, false);

        $sql = "UPDATE tiendas 
                SET nombre_tienda = :nombre_tienda,
                    direcc_tienda = :direcc_tienda,
                    ciudad = :ciudad,
                    estado = :estado,
                    pais = :pais,
                    cod_postal = :cod_postal
                WHERE id_tienda = :id_tienda";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_tienda'     => $this->id_tienda,
            ':nombre_tienda' => $this->nombre_tienda,
            ':direcc_tienda' => $this->direcc_tienda,
            ':ciudad'        => $this->ciudad,
            ':estado'        => $this->estado,
            ':pais'          => $this->pais,
            ':cod_postal'    => $this->cod_postal,
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM tiendas WHERE id_tienda = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => trim($id)]);
    }

    private function asignarYValidar(array $datos, bool $esCreacion): void
    {
        $this->id_tienda     = trim($datos['id_tienda'] ?? '');
        $this->nombre_tienda = trim($datos['nombre_tienda'] ?? '');
        $this->direcc_tienda = trim($datos['direcc_tienda'] ?? '') ?: null;
        $this->ciudad        = trim($datos['ciudad'] ?? '') ?: null;
        $this->estado        = trim($datos['estado'] ?? '') ?: null;
        $this->pais          = trim($datos['pais'] ?? '') ?: null;
        $this->cod_postal    = trim($datos['cod_postal'] ?? '') ?: null;

        if ($esCreacion && $this->id_tienda === '') {
            throw new InvalidArgumentException('El código de la tienda (id_tienda) es obligatorio.');
        }

        if ($this->nombre_tienda === '') {
            throw new InvalidArgumentException('El nombre de la tienda no puede estar vacío.');
        }
    }
}