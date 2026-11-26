<?php

class Titulo
{
    private PDO $db;
    private string $id_titulo = '';
    private string $titulo = '';
    private string $tipo = 'General';
    private ?string $id_pub = null;
    private float $precio = 0.0;
    private ?string $notas = null;
    private string $fecha_pub = '';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAll(): array
    {
        $sql = "SELECT t.id_titulo, t.titulo, t.tipo, t.id_pub, t.precio, t.fecha_pub, p.nombre_pub
                FROM titulos t
                LEFT JOIN publicadores p ON t.id_pub = p.id_pub
                ORDER BY t.titulo ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPublicadores(): array
    {
        $sql = "SELECT id_pub, nombre_pub FROM publicadores ORDER BY nombre_pub ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById(string $id): ?array
    {
        $sql = "SELECT id_titulo, titulo, tipo, id_pub, precio, notas, fecha_pub
                FROM titulos
                WHERE id_titulo = :id
                LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => trim($id)]);
        $registro = $stmt->fetch();

        return $registro ?: null;
    }

    public function create(array $datos): bool
    {
        $this->asignarYValidar($datos, true);

        if ($this->getById($this->id_titulo) !== null) {
            throw new InvalidArgumentException("Ya existe un título con el código '{$this->id_titulo}'.");
        }

        $sql = "INSERT INTO titulos (id_titulo, titulo, tipo, id_pub, precio, notas, fecha_pub)
                VALUES (:id_titulo, :titulo, :tipo, :id_pub, :precio, :notas, :fecha_pub)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_titulo' => $this->id_titulo,
            ':titulo'    => $this->titulo,
            ':tipo'      => $this->tipo,
            ':id_pub'    => $this->id_pub,
            ':precio'    => $this->precio,
            ':notas'     => $this->notas,
            ':fecha_pub' => $this->fecha_pub,
        ]);
    }

    public function update(string $id, array $datos): bool
    {
        $datos['id_titulo'] = $id;
        $this->asignarYValidar($datos, false);

        $sql = "UPDATE titulos
                SET titulo = :titulo,
                    tipo = :tipo,
                    id_pub = :id_pub,
                    precio = :precio,
                    notas = :notas,
                    fecha_pub = :fecha_pub
                WHERE id_titulo = :id_titulo";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id_titulo' => $this->id_titulo,
            ':titulo'    => $this->titulo,
            ':tipo'      => $this->tipo,
            ':id_pub'    => $this->id_pub,
            ':precio'    => $this->precio,
            ':notas'     => $this->notas,
            ':fecha_pub' => $this->fecha_pub,
        ]);
    }

    public function delete(string $id): bool
    {
        $sql = "DELETE FROM titulos WHERE id_titulo = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => trim($id)]);
    }

    private function asignarYValidar(array $datos, bool $esCreacion): void
    {
        $this->id_titulo = trim($datos['id_titulo'] ?? '');
        $this->titulo    = trim($datos['titulo'] ?? '');
        $this->tipo      = trim($datos['tipo'] ?? '') ?: 'General';
        $this->id_pub    = trim($datos['id_pub'] ?? '') ?: null;
        $this->precio    = (float) ($datos['precio'] ?? 0);
        $this->notas     = trim($datos['notas'] ?? '') ?: null;
        $fechaInput      = trim($datos['fecha_pub'] ?? '');
        $this->fecha_pub = $fechaInput !== '' ? $fechaInput : date('Y-m-d');

        if ($esCreacion && $this->id_titulo === '') {
            throw new InvalidArgumentException('El código del título (id_titulo) es obligatorio.');
        }

        if ($this->titulo === '') {
            throw new InvalidArgumentException('El nombre del libro no puede estar vacío.');
        }

        if ($this->precio < 0) {
            throw new InvalidArgumentException('El precio del libro no puede ser negativo.');
        }
    }
}