import React from 'react';
import { TextInput, Textarea, SimpleGrid, Group, Title, Button } from '@mantine/core';
import { useForm } from '@mantine/form';

function FormComments() {
  const form = useForm({
    initialValues: {
      name: '',
      email: '',
      comment: '',
    },
    validate: {
      name: (value) => value.trim().length < 2,
      email: (value) => !/^\S+@\S+$/.test(value),
      comment: (value) => value.trim().length === 0,
    },
  });

  return (
    <form onSubmit={form.onSubmit(() => {})}>
      <Title
        order={2}
        size="h1"
        style={{ fontFamily: 'Greycliff CF, var(--mantine-font-family)' }}
        fw={900}
        ta="center"
      >
        Deja tu comentario
      </Title>

      <SimpleGrid cols={{ base: 1, sm: 2 }} mt="xl">
        <TextInput
          label="Nombre"
          placeholder="escribe tu nombre"
          name="name"
          variant="filled"
          {...form.getInputProps('name')}
        />
        <TextInput
          label="Correo electronico"
          placeholder="example@gmail.com"
          name="email"
          variant="filled"
          {...form.getInputProps('email')}
        />
      </SimpleGrid>

      <Textarea
        mt="md"
        label="Comentario"
        placeholder="Deja tu comentario aquí"
        maxRows={10}
        minRows={5}
        autosize
        name="comment"
        variant="filled"
        {...form.getInputProps('comment')}
      />

      <Group justify="center" mt="xl">
        <Button type="submit" size="md">
          Enviar comentario 
        </Button>
      </Group>
    </form>
  );
}

export default FormComments;