export function getRandomPhotos(photoList, shuffleCount = 4) {
    if (!Array.isArray(photoList) || photoList.length === 0) {
      console.warn("getRandomPhotos: Передан пустой или некорректный массив.");
      return [];
    }

    if (shuffleCount > photoList.length) {
      console.warn("getRandomPhotos: Количество запрашиваемых элементов больше длины массива.");
      shuffleCount = photoList.length;
    }

    // Перемешиваем массив
    const shuffledPhotos = [...photoList]
      .sort(() => Math.random() - 0.5)
      .slice(0, shuffleCount); // Берём нужное количество элементов

    return shuffledPhotos;
  }
