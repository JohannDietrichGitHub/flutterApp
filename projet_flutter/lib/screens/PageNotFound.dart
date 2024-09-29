import 'package:flutter/material.dart';

class PageNotFound extends StatelessWidget {
  const PageNotFound({super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Page not found'),
      ),
      body: Center(
        child: Column(
          children: const [
            Text(
              '404 - Page not found',
              style: TextStyle(fontSize: 24),
            ),
            Text(
              'The page you are looking for does not exist.',
              style: TextStyle(fontSize: 24),
            ),
          ],
        ),
      ),
    );
  }
}