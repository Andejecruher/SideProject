import React, { useState } from 'react';
import { TextInput, Textarea, SimpleGrid, Group, Title, Button } from '@mantine/core';
import { IconCheck } from '@tabler/icons-react';
import CircularProgress from '@mui/material/CircularProgress';
import { useForm } from '@mantine/form';
import { useBlog } from '@src/Context/BlogContext';
import { notifications } from '@mantine/notifications';

function FormComments() {
  const [loading, setLoading] = useState(false);
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
  const { fetchCreateComment, article } = useBlog();

  const handleSubmit = () => {
    setLoading(true);
    const data = {
      article_id: article.id,
      author_name: form.values.name,
      author_email: form.values.email,
      content: form.values.comment,
    };
    fetchCreateComment(data);
    notifications.show({
      title: `Comentario enviado`,
      message: `Gracias por tu comentario, será revisado por un moderador antes de ser publicado`,
      position: 'top-right',
      icon: <IconCheck />,
      className: 'my-notification-class',
      autoClose: 5000,
    });
    form.initialize({ name: '', email: '', comment: '' });
    form.reset();
    setLoading(false);
  };

  return (

    <>
      <form onSubmit={form.onSubmit(() => handleSubmit())}>
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
            {...form.getInputProps('name')} />
          <TextInput
            label="Correo electronico"
            placeholder="example@gmail.com"
            name="email"
            variant="filled"
            {...form.getInputProps('email')} />
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
          {...form.getInputProps('comment')} />

        <Group justify="center" mt="xl">
          <Button type="submit" size="md" disabled={loading}>
            {loading ? <CircularProgress size={24} color='inherit' /> : 'Enviar comentario'}
          </Button>
        </Group>
      </form>
    </>
  );
}

export default FormComments;